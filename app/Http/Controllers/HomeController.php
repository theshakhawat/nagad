<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    /**
     * Show the main admin dashboard.
     */
    public function index()
    {
        return redirect()->route('login');
    }
}
