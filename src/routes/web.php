<?php

use Illuminate\Support\Facades\Route;
use Molitor\Cms\Http\Controllers\AuthorController;
use Molitor\Cms\Http\Controllers\PageController;
use Molitor\Cms\Http\Controllers\PostController;
use Molitor\Cms\Http\Controllers\PostGroupController;

Route::middleware(['web'])->group(function () {
    Route::get('/page', [PageController::class, 'index'])->name('cms.page.index');
    Route::get('/page/{slug}', [PageController::class, 'show'])->name('cms.page.show');
    Route::get('/post', [PostController::class, 'index'])->name('cms.post.index');
    Route::get('/post/{slug}', [PostController::class, 'show'])->name('cms.post.show');
    Route::get('/post-group', [PostGroupController::class, 'index'])->name('cms.post-group.index');
    Route::get('/post-group/{slug}', [PostGroupController::class, 'show'])->name('cms.post-group.show');
    Route::get('/author', [AuthorController::class, 'index'])->name('cms.author.index');
    Route::get('/author/{slug}', [AuthorController::class, 'show'])->name('cms.author.show');
});
