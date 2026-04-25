<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/contact', [HomeController::class, 'contact'])->name('contact.store');

Route::prefix('artikel')->name('artikel.')->group(function () {
    Route::get('/', [ArticleController::class, 'index'])->name('index');
    Route::get('/{article:slug}', [ArticleController::class, 'show'])->name('show');
});

Route::prefix('daftar-email')->name('email.')->group(function () {
    Route::get('/mailing-list', [EmailController::class, 'mailingList'])->name('mailing-list');
    Route::get('/seluruh-staff', [EmailController::class, 'seluruhStaff'])->name('seluruh-staff');
    Route::get('/workspace', [EmailController::class, 'workspace'])->name('workspace');
});
