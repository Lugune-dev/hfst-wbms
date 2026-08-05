<?php

use App\Http\Controllers\PublicController;
use App\Http\Controllers\DonorReceiptController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PublicController::class, 'home'])->name('home');
Route::get('/about', [PublicController::class, 'about'])->name('about');
Route::get('/projects', [PublicController::class, 'programs'])->name('projects');
Route::get('/programs', [PublicController::class, 'programs'])->name('programs');
Route::get('/news', [PublicController::class, 'news'])->name('news');
Route::get('/donate', [PublicController::class, 'donate'])->name('donate');
Route::get('/contact', [PublicController::class, 'contact'])->name('contact');

Route::post('/subscribe', [PublicController::class, 'subscribe'])->name('subscribe');
Route::post('/language/{locale}', [PublicController::class, 'setLanguage'])->name('language.switch');

// Redirection to panel logins
Route::get('/login', function () {
    return view('auth.login-selection');
})->name('login');

// Donor receipt download (authenticated)
Route::get('/donor/receipt/{donation}', [DonorReceiptController::class, 'show'])
    ->name('donor.receipt')
    ->middleware('auth');

