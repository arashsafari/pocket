<?php

use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\CurrencyController;
use App\Http\Controllers\Api\V1\DepositController;
use App\Http\Controllers\Api\V1\PaymentController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('v1')->middleware('throttle:50,1')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);

    Route::middleware('auth')->group(function () {
        Route::post('/logout',  [AuthController::class, 'logout']);
        Route::get('/refresh', [AuthController::class, 'refresh']);
        Route::get('/get-me', [AuthController::class, 'getMe']);

        Route::resource('payments', PaymentController::class)->only(['index', 'store', 'show', 'destroy']);
        Route::patch('payments/{payment}/reject', [PaymentController::class, 'reject']);
        Route::patch('payments/{payment}/approve', [PaymentController::class, 'approve']);

        Route::resource('currencies', CurrencyController::class)->only(['index', 'store', 'show']);
        Route::patch('currencies/{currency}/active', [CurrencyController::class, 'active']);
        Route::patch('currencies/{currency}/deactive', [CurrencyController::class, 'deactive']);

        Route::post('deposit/transfer', [DepositController::class, 'transfer']);
    });
});
