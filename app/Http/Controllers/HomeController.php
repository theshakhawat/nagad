<?php

namespace App\Http\Controllers;

use App\Services\NagadService;

class HomeController extends Controller
{
    /**
     * Show the main admin dashboard.
     */

    public function __construct(protected NagadService $nagadService)
    {
    }


    public function index()
    {
        return redirect()->route('login');
    }

    // Test
    public function pay()
    {
        $amount = 100; // Example amount
        $currency = 'BDT'; // Example currency
        $orderId = 'ORDER12345'.time(); // Example order ID
        $customerName = 'John Doe'; //

        // initite payment
        $response = $this->nagadService->initialize($orderId);
        dd($response);
    }
}
