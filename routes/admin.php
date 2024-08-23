<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin;
use Inertia\Inertia;

Route::get('/', [Admin\DashboardController::class, 'index'])->name('dashboard');

Route::resource('/products', Admin\ProductController::class);
Route::resource('/product_categories', Admin\ProductCategoriesController::class)->except('show');
Route::get('/', function () {
    return Inertia::render('Admin/Dashboard');
})->name('dashboard');
