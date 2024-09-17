<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ShortUrlController;
use App\Http\Controllers\Api\Auth\AuthController;

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::group([
        'prefix' => '/short-url'
    ], function () {
        Route::post('', [ShortUrlController::class, 'store']);
        Route::get('', [ShortUrlController::class, 'show']);
    });

    Route::post('/logout', [AuthController::class, 'logout']);
});
