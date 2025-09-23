<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| All routes under the 'admin' prefix. Public routes are for login only.
| All other routes require 'auth:admin' middleware.
|
*/

Route::prefix('admin')->group(function () {

    // --------------------------
    // Public routes (no auth)
    // --------------------------
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('admin.login');
    Route::post('login', [LoginController::class, 'login'])->name('admin.login.submit');

    // --------------------------
    // Protected routes (require admin login)
    // --------------------------
    Route::middleware('auth:admin')->group(function () {

        // Dashboard
        Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');

        // Logout
        Route::post('logout', [LoginController::class, 'logout'])->name('admin.logout');

        // CRUD routes
        Route::resource('categories', CategoryController::class);
        Route::resource('products', ProductController::class);
    });
});
