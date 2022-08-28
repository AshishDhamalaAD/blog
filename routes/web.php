<?php

use App\Http\Controllers\Front\ArticleDetailController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\TagArticlesController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class);
Route::get('articles/{article:slug}', ArticleDetailController::class)->name('articles.show');
Route::get('tags/{tag:slug}/articles', TagArticlesController::class)->name('tags.articles');
