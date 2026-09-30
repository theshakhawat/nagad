<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use RuntimeException;

class NagadService
{
    protected string $publicKey;
    protected string $privateKey;

    /**
     * Create a new NagadService instance.
     *
     * @throws RuntimeException
     */
    public function __construct()
    {
        $publicKeyPath = storage_path(config('nagad.public_key'));
        $privateKeyPath = storage_path(config('nagad.private_key'));

        if (! file_exists($publicKeyPath)) {
            throw new RuntimeException("Nagad public key not found: {$publicKeyPath}");
        }

        if (! file_exists($privateKeyPath)) {
            throw new RuntimeException("Nagad private key not found: {$privateKeyPath}");
        }

        $this->publicKey = file_get_contents($publicKeyPath);
        $this->privateKey = file_get_contents($privateKeyPath);
    }

    /**
     * 1. Initialize payment request.
     */

     public function initialize(string $orderId): object
    {
        $merchantId = config('nagad.merchant_id');
        $url = rtrim(config('nagad.base_url')) . "/check-out/initialize/{$merchantId}/{$orderId}";
        $dateTime = now('Asia/Dhaka')->format('YmdHis');

        $sensitiveData = [
            'merchantId' => $merchantId,
            'datetime'   => $dateTime,
            'orderId'    => $orderId,
            'challenge'  => $this->generateChallenge(),
        ];

        $encryptedData = $this->encrypt($sensitiveData);
        $signature = $this->sign($sensitiveData);

        $payload = [
            'accountNumber' => config('nagad.account_number'),
            'dateTime'      => $dateTime,
            'sensitiveData' => $encryptedData,
            'signature'     => $signature,
        ];

        $response = Http::withHeaders($this->getHeaders())
            ->acceptJson()
            ->asJson()
            ->post($url, $payload);

        if ($response->failed()) {
            throw new RuntimeException("Nagad initialize request failed: {$response->body()}");
        }

        $responseData = $response->json();

        if (! is_array($responseData) || empty($responseData['sensitiveData']) || empty($responseData['signature'])) {
            throw new RuntimeException('Invalid or missing sensitiveData in Nagad initialize response.');
        }

        $plainData = $this->decryptRaw($responseData['sensitiveData']);
        $isValid = $this->verifySignature($plainData, $responseData['signature']);

        if (! $isValid) {
            throw new RuntimeException('Nagad initialize response signature verification failed.');
        }

        $decryptedData = json_decode($plainData, true);

        return (object) [
            'raw'  => $responseData,
            'data' => $decryptedData,
        ];
    }

    /**
     * 2. Complete checkout and generate redirect gateway URL.
     */
    public function complete(string $orderId, string $amount, array $initializeData): object
    {
        $paymentReferenceId = $initializeData['paymentReferenceId']
            ?? throw new RuntimeException('Payment reference ID not found.');

        $challenge = $initializeData['challenge']
            ?? $initializeData['random']
            ?? throw new RuntimeException('Challenge not found in Initialize response.');

        $sensitiveData = [
            'merchantId'   => config('nagad.merchant_id'),
            'orderId'      => $orderId,
            'amount'       => number_format((float) $amount, 2, '.', ''),
            'currencyCode' => '050',
            'challenge'    => $challenge,
        ];

        $encryptedData = $this->encrypt($sensitiveData);
        $signature = $this->sign($sensitiveData);

        $url = rtrim(config('nagad.base_url')) . "/check-out/complete/{$paymentReferenceId}";

        $payload = [
            'sensitiveData'       => $encryptedData,
            'signature'           => $signature,
            'merchantCallbackURL' => config('nagad.callback_url'),
        ];

        $response = Http::withHeaders($this->getHeaders())
            ->acceptJson()
            ->asJson()
            ->post($url, $payload);

        if ($response->failed()) {
            throw new RuntimeException("Nagad complete request failed: {$response->body()}");
        }

        $responseData = $response->json();

        if (! is_array($responseData)) {
            throw new RuntimeException('Invalid response received from Nagad Complete API.');
        }

        return (object) $responseData;
    }

    /**
     * 3. Verify payment status using paymentReferenceId.
     */
    public function verify(string $paymentReferenceId): object
    {
        $url = rtrim(config('nagad.base_url'), '/') . "/verify/payment/{$paymentReferenceId}";

        $response = Http::withHeaders($this->getHeaders())
            ->acceptJson()
            ->get($url);

        if ($response->failed()) {
            throw new RuntimeException("Nagad verify request failed: {$response->body()}");
        }

        $responseData = $response->json();

        if (! is_array($responseData)) {
            throw new RuntimeException('Invalid response received from Nagad Verify API.');
        }

        return (object) $responseData;
    }

    public function generateChallenge(int $length = 20): string
    {
        return bin2hex(random_bytes($length));
    }

    /*
    |--------------------------------------------------------------------------
    | Cryptographic & Helper Methods
    |--------------------------------------------------------------------------
    */

    protected function encrypt(array $data): string
    {
        $jsonData = json_encode($data, JSON_UNESCAPED_SLASHES);
        $publicKey = openssl_pkey_get_public($this->publicKey);

        if ($publicKey === false) {
            throw new RuntimeException('Invalid Nagad gateway public key.');
        }

        $encrypted = null;
        openssl_public_encrypt($jsonData, $encrypted, $publicKey, OPENSSL_PKCS1_PADDING);

        return base64_encode($encrypted);
    }

    protected function sign(array $data): string
    {
        $jsonData = json_encode($data, JSON_UNESCAPED_SLASHES);
        $privateKey = openssl_pkey_get_private($this->privateKey);

        if ($privateKey === false) {
            throw new RuntimeException('Invalid Nagad merchant private key.');
        }

        $signature = '';
        openssl_sign($jsonData, $signature, $privateKey, OPENSSL_ALGO_SHA256);

        return base64_encode($signature);
    }

    protected function decryptRaw(string $encryptedData): string
    {
        $decodedData = base64_decode($encryptedData, true);
        $privateKey = openssl_pkey_get_private($this->privateKey);

        if ($privateKey === false) {
            throw new RuntimeException('Invalid Nagad merchant private key.');
        }

        $decrypted = '';
        openssl_private_decrypt($decodedData, $decrypted, $privateKey, OPENSSL_PKCS1_PADDING);

        return $decrypted;
    }

    protected function verifySignature(string $plainData, string $signature): bool
    {
        $decodedSignature = base64_decode($signature, true);
        $publicKey = openssl_pkey_get_public($this->publicKey);

        if ($publicKey === false) {
            throw new RuntimeException('Invalid Nagad gateway public key.');
        }

        $result = openssl_verify($plainData, $decodedSignature, $publicKey, OPENSSL_ALGO_SHA256);

        return $result === 1;
    }

    protected function getHeaders(): array
    {
        return [
            'Content-Type'     => 'application/json',
            'X-KM-Api-Version' => config('nagad.api_version'),
            'X-KM-Client-Type' => config('nagad.client_type'),
            'X-KM-IP-V4'       => config('nagad.server_ip'),
        ];
    }
}
