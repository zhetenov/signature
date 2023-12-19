<?php

use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;

Route::post('/payment/gateway-one/callback', [PaymentController::class, 'handleGatewayOne']);
Route::post('/payment/gateway-two/callback', [PaymentController::class, 'handleGatewayTwo']);
