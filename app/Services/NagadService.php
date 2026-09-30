<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use RuntimeException;

class NagadService
{
    protected string $publicKey;

    protected string $privateKey;

    public function __construct()
    {
        $publicKeyPath = storage_path(
            config('nagad.public_key')
        );

        $privateKeyPath = storage_path(
            config('nagad.private_key')
        );

        if (! file_exists($publicKeyPath)) {
            throw new RuntimeException(
                "Nagad public key not found: {$publicKeyPath}"
            );
        }

        if (! file_exists($privateKeyPath)) {
            throw new RuntimeException(
                "Nagad private key not found: {$privateKeyPath}"
            );
        }

        $this->publicKey = file_get_contents($publicKeyPath);
        $this->privateKey = file_get_contents($privateKeyPath);
    }

    protected function encrypt(array $data): string
    {
        // Encode the data to JSON format for Remove slashes in the JSON string
        $jsonData = json_encode($data, JSON_UNESCAPED_SLASHES);

        // Check if JSON encoding was successful
        if ($jsonData === false) {
            throw new RuntimeException(
                'Failed to encode Nagad data.'
            );
        }

        // Get the public key resource
        $publicKey = openssl_pkey_get_public(
            $this->publicKey
        );

        // Validate the public key resource
        if ($publicKey === false) {
            throw new RuntimeException(
                'Invalid Nagad public key.'
            );
        }

        // Initialize an empty string to hold the encrypted data
        $encrypted = null;

        // Encrypt the JSON data using the public key
        $success = openssl_public_encrypt(
            $jsonData,
            $encrypted,
            $publicKey,
            OPENSSL_PKCS1_PADDING
        );

        if (! $success) {
            throw new RuntimeException(
                'Nagad encryption failed.'
            );
        }

        return base64_encode($encrypted);
    }

    protected function sign(array $data): string
    {
        $jsonData = json_encode(
            $data,
            JSON_UNESCAPED_SLASHES
        );

        if ($jsonData === false) {
            throw new RuntimeException(
                'Failed to encode Nagad data.'
            );
        }

        $privateKey = openssl_pkey_get_private(
            $this->privateKey
        );

        if ($privateKey === false) {
            throw new RuntimeException(
                'Invalid Nagad private key.'
            );
        }

        $signature = '';
        $success = openssl_sign(
            $jsonData,
            $signature,
            $privateKey,
            OPENSSL_ALGO_SHA1
        );

        if (! $success) {
            throw new RuntimeException(
                'Nagad signature generation failed.'
            );
        }

        return base64_encode($signature);
    }

    public function initialize(string $orderId): object
    {
        $merchantId = config('nagad.merchant_id');
        $url = rtrim(config('nagad.base_url'))."/check-out/initialize/{$merchantId}/{$orderId}";

        $sensitiveData = [
            'merchantId' => $merchantId,
            'dateTime' => now('Asia/Dhaka')->format('YmdHis'),
            'orderId' => $orderId,
            'challenge' => $this->generateChallenge(),
        ];

        $encryptedData = $this->encrypt($sensitiveData);
        $signature = $this->sign($sensitiveData);

        $payload = [
            'accountNumber' => config('nagad.account_number'),
            'dateTime' => now('Asia/Dhaka')->format('YmdHis'),
            'sensitiveData' => $encryptedData,
            'signature' => $signature,
        ];

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'X-KM-Api-Version' => config('nagad.api_version'),
            'X-KM-Client-Type' => config('nagad.client_type'),
            'X-KM-IP-V4' => config('nagad.server_ip'),
        ])
            ->acceptJson()
            ->asJson()
            ->post($url, $payload);

        if ($response->failed()) {
            throw new RuntimeException(
                "Nagad initialize request failed: {$response->body()}"
            );
        }

        $responseData = $response->json();

        if (! is_array($responseData)) {
            throw new RuntimeException(
                'Invalid response received from Nagad.'
            );
        }

        return (object) $responseData;
    }

    public function generateChallenge(): string
    {
        return bin2hex(random_bytes(16));
    }
}
