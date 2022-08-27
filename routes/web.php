<?php

use App\Http\Controllers\Front\ArticleDetailController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\TagArticlesController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class);
Route::get('articles/{article}', ArticleDetailController::class)->name('articles.show');
Route::get('tags/{tag}/articles', TagArticlesController::class)->name('tags.articles');
