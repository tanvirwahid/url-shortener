<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShortUrlController;

Route::get('/', function () {
    return view('home');
})->name('home');

require __DIR__ . '/auth.php';

Route::group([
    'prefix' => '/short-url',
    'as' => 'short-url.'
], function () {
    Route::get('', [ShortUrlController::class, 'index'])->name('index')->middleware('auth');
    Route::post('', [ShortUrlController::class, 'store'])->name('store');
    Route::post('/{id}/generate', [ShortUrlController::class, 'generate'])->name('generate');
});

Route::get('/{shortUrl}', [ShortUrlController::class, 'refirect'])->middleware(['url-checker']);
