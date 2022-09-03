<?php

use App\Http\Controllers\Front\AboutController;
use App\Http\Controllers\Front\ArticleDetailController;
use App\Http\Controllers\Front\ContactController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\TagArticlesController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');
Route::get('articles/{article:slug}', ArticleDetailController::class)->name('articles.show');
Route::get('tags/{tag:slug}/articles', TagArticlesController::class)->name('tags.articles');
Route::get('about-us', AboutController::class)->name('about-us');
Route::get('contact-us', ContactController::class)->name('contact-us');
