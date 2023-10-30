<?php

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

if (!auth()->check()) {
    $user = User::query()->latest()->first();
    auth()->login($user);
}

Route::prefix('v1')->middleware('throttle:50,1')->group(function () {
    Route::resource('payments', PaymentController::class)->only(['index', 'store', 'show', 'destroy']);
    Route::patch('payments/{payment}/reject', [PaymentController::class, 'reject']);
    Route::patch('payments/{payment}/approve', [PaymentController::class, 'approve']);

    Route::resource('currencies', CurrencyController::class)->only(['index', 'store', 'show']);
    Route::patch('currencies/{currency}/active', [CurrencyController::class, 'active']);
    Route::patch('currencies/{currency}/deactive', [CurrencyController::class, 'deactive']);

    Route::post('deposit/transfer', [DepositController::class, 'transfer']);
});
