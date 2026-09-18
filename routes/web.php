<?php

use App\Http\Controllers\PublicController;
use App\Http\Controllers\DonorReceiptController;
use App\Http\Controllers\DonorRegistrationController;
use Illuminate\Support\Facades\Route;

// Public Pages
Route::get('/', [PublicController::class, 'home'])->name('home');
Route::get('/about', [PublicController::class, 'about'])->name('about');
Route::get('/projects', [PublicController::class, 'programs'])->name('projects');
Route::get('/programs', [PublicController::class, 'programs'])->name('programs');
Route::get('/schools', [PublicController::class, 'schools'])->name('schools');
Route::get('/news', [PublicController::class, 'news'])->name('news');
Route::get('/contact', [PublicController::class, 'contact'])->name('contact');

// Online Donation Flow (Tanzania Mobile Money & Bank)
Route::get('/donate', [PublicController::class, 'donate'])->name('donate');
Route::post('/donate/process', [PublicController::class, 'processDonation'])->name('donate.process');
Route::get('/donate/success/{donation}', [PublicController::class, 'donationSuccess'])->name('donate.success');

// Student Aid Application Flow (Public Beneficiary Application)
Route::get('/apply', [PublicController::class, 'apply'])->name('apply');
Route::post('/apply', [PublicController::class, 'submitApplication'])->name('apply.submit');
Route::get('/apply/success/{application}', [PublicController::class, 'applicationSuccess'])->name('apply.success');

// Legal & Compliance (Tanzania Data Protection Act 2022)
Route::get('/privacy-policy', [PublicController::class, 'privacyPolicy'])->name('privacy');
Route::get('/terms', [PublicController::class, 'terms'])->name('terms');

// Newsletter & Language Switcher
Route::post('/subscribe', [PublicController::class, 'subscribe'])->name('subscribe');
Route::match(['get', 'post'], '/language/{locale}', [PublicController::class, 'setLanguage'])->name('language.switch');

// Multi-Portal Login Selection
Route::get('/login', function () {
    return view('auth.login-selection');
})->name('login');

// Donor Self-Registration (Public)
Route::get('/donor/register', [DonorRegistrationController::class, 'create'])->name('donor.register');
Route::post('/donor/register', [DonorRegistrationController::class, 'store'])->name('donor.register.store');

// Official Donor Receipt Download (PDF & Printable)
Route::get('/donor/receipt/{donation}', [DonorReceiptController::class, 'show'])->name('donor.receipt');
