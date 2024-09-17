<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShortUrlController;

Route::get('/', function () {
    return view('home');
})->name('home');

require __DIR__.'/auth.php';

Route::post('/short-url', [ShortUrlController::class, 'store'])->name('short-url.store');
Route::post('/{id}/generate', [ShortUrlController::class, 'generate']);
Route::get('/{shortUrl}', [ShortUrlController::class, 'refirect'])->middleware(['url-checker']);


