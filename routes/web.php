<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShortUrlController;

require __DIR__.'/auth.php';

Route::get('/', function () {
    return view('home');
})->name('home');



Route::post('/short-url', [ShortUrlController::class, 'store'])->name('short-url.store');
Route::get('/{shortUrl}', [ShortUrlController::class, 'refirect'])->middleware(['url-checker']);


