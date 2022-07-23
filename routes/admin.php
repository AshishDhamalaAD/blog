<?php

use App\Http\Controllers\Admin\ArticlesController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UsersController;
use Illuminate\Support\Facades\Route;

Route::get('dashboard', DashboardController::class)->middleware(['auth'])->name('dashboard');

Route::resource('users', UsersController::class);
Route::resource('articles', ArticlesController::class);

require __DIR__.'/auth.php';

