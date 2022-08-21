<?php

use App\Http\Controllers\Admin\AdvertisementsController;
use App\Http\Controllers\Admin\ArticlesController;
use App\Http\Controllers\Admin\SubMenusController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MenusController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\WebsiteController;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth'])->group(function () {
    Route::get('dashboard', DashboardController::class)->name('dashboard');

    Route::resource('users', UsersController::class);
    Route::resource('articles', ArticlesController::class);
    Route::resource('menus', MenusController::class);
    Route::resource('sub-menus', SubMenusController::class);
    Route::resource('advertisements', AdvertisementsController::class);

    Route::get('website', [WebsiteController::class, 'edit'])->name('websites.edit');
    Route::post('website', [WebsiteController::class, 'update'])->name('websites.update');

    Route::prefix('laravel-filemanager')->group(function () {
        \UniSharp\LaravelFilemanager\Lfm::routes();
    });
});


require __DIR__ . '/auth.php';
