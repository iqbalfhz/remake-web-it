<?php

use App\Http\Controllers\Admin\ArticleController as AdminArticleController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\CommentController as AdminCommentController;
use App\Http\Controllers\Admin\ContactController as AdminContactController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MailingListController as AdminMailingListController;
use App\Http\Controllers\Admin\PermissionController as AdminPermissionController;
use App\Http\Controllers\Admin\RoleController as AdminRoleController;
use App\Http\Controllers\Admin\StaffEmailController as AdminStaffEmailController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/contact', [HomeController::class, 'contact'])->name('contact.store');

Route::prefix('artikel')->name('artikel.')->group(function () {
    Route::get('/', [ArticleController::class, 'index'])->name('index');
    Route::get('/{artikel:slug}', [ArticleController::class, 'show'])->name('show');
    Route::post('/{artikel:slug}/komentar', [CommentController::class, 'store'])->name('komentar.store');
});

Route::prefix('daftar-email')->name('email.')->group(function () {
    Route::get('/mailing-list', [EmailController::class, 'mailingList'])->name('mailing-list');
    Route::get('/seluruh-staff', [EmailController::class, 'seluruhStaff'])->name('seluruh-staff');
    Route::get('/workspace', [EmailController::class, 'workspace'])->name('workspace');
});

require __DIR__.'/auth.php';

// Redirect Breeze default /dashboard ke admin panel
Route::get('/dashboard', fn () => redirect()->route('admin.dashboard'))
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('artikel', AdminArticleController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
    Route::post('artikel/image', [AdminArticleController::class, 'uploadImage'])->name('artikel.image');
    Route::resource('kategori', AdminCategoryController::class)->only(['index', 'store', 'update', 'destroy']);
    Route::resource('komentar', AdminCommentController::class)->only(['index', 'destroy']);
    Route::resource('contacts', AdminContactController::class)->only(['index', 'destroy']);
    Route::resource('mailing-list', AdminMailingListController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
    Route::resource('staff-email', AdminStaffEmailController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
    Route::get('workspace-email', [AdminStaffEmailController::class, 'workspace'])->name('workspace-email');
    Route::get('users', [AdminUserController::class, 'index'])->name('users.index');
    Route::patch('users/{user}/approve', [AdminUserController::class, 'approve'])->name('users.approve');
    Route::patch('users/{user}/toggle', [AdminUserController::class, 'toggle'])->name('users.toggle');
    Route::patch('users/{user}/role', [AdminUserController::class, 'assignRole'])->name('users.role');
    Route::delete('users/{user}/reject', [AdminUserController::class, 'reject'])->name('users.reject');

    Route::resource('roles', AdminRoleController::class)->only(['index', 'store', 'edit', 'update', 'destroy']);
    Route::resource('permissions', AdminPermissionController::class)->only(['index', 'store', 'destroy']);
});
