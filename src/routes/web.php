<?php

use Illuminate\Support\Facades\Route;
use Molitor\Cms\Http\Controllers\AuthorController;
use Molitor\Cms\Http\Controllers\HomepageController;
use Molitor\Cms\Http\Controllers\KeywordController;
use Molitor\Cms\Http\Controllers\PageController;
use Molitor\Cms\Http\Controllers\PostController;
use Molitor\Cms\Http\Controllers\PostGroupController;
use Molitor\Cms\Http\Controllers\PostTypeController;
use Molitor\Cms\Http\Controllers\SearchController;

Route::middleware(['web'])->group(function () {
    Route::get('/', [HomepageController::class, 'index'])->name('homepage');
    Route::get('/post', [PostController::class, 'index'])->name('cms.post.index');
    Route::get('/post/{slug}', [PostController::class, 'show'])->name('cms.post.show');
    Route::get('/tag-group', [KeywordController::class, 'groups'])->name('cms.tag-group.index');
    Route::get('/tag/{slug}', [KeywordController::class, 'show'])->name('cms.tag.show');
    Route::get('/post-group', [PostGroupController::class, 'index'])->name('cms.post-group.index');
    Route::get('/post-group/{slug}', [PostGroupController::class, 'show'])->name('cms.post-group.show');
    Route::get('/post-type/{slug}', [PostTypeController::class, 'show'])->name('cms.post-type.show');
    Route::get('/author', [AuthorController::class, 'index'])->name('cms.author.index');
    Route::get('/author/{slug}', [AuthorController::class, 'show'])->name('cms.author.show');
    Route::get('/search', SearchController::class)->name('cms.search');
    Route::get('/{slug}', [PageController::class, 'show'])->name('cms.page.show');
});
