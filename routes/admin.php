<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UsersController;
use Illuminate\Support\Facades\Route;

Route::get('dashboard', DashboardController::class)->middleware(['auth'])->name('dashboard');

Route::get('users', [UsersController::class, 'index'])->name('users.index');

require __DIR__.'/auth.php';

