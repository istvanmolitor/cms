<?php

use Illuminate\Support\Facades\Route;
use Molitor\Cms\Http\Controllers\HomepageController;
use Molitor\Cms\Http\Controllers\PageController;
use Molitor\Cms\Http\Controllers\PostController;
use Molitor\Cms\Http\Controllers\PostGroupController;

Route::get('/', [HomepageController::class, 'index'])->name('cms.homepage');
Route::get('/page', [PageController::class, 'index'])->name('cms.page.index');
Route::get('/page/{slug}', [PageController::class, 'show'])->name('cms.page.show');
Route::get('/post', [PostController::class, 'index'])->name('cms.post.index');
Route::get('/post/{slug}', [PostController::class, 'show'])->name('cms.post.show');
Route::get('/post-group/{slug}', [PostGroupController::class, 'show'])->name('cms.post-group.show');
