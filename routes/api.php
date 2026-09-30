<?php

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response()->json(['message' => 'API is working']);
});
Route::post('/nagad/payment/initiate', [ApiController::class, 'nagadInitiate']);