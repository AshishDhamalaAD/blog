<?php

use App\Http\Controllers\ArticleDetailController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TagArticlesController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class);
Route::get('articles/{article}', ArticleDetailController::class)->name('articles.show');
Route::get('tags/{tag}/articles', TagArticlesController::class)->name('tags.articles');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
