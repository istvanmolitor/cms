<?php

use Illuminate\Support\Facades\Route;
use Molitor\Cms\Http\Controllers\Api\AuthorApiController;
use Molitor\Cms\Http\Controllers\Api\ContentRegionApiController;
use Molitor\Cms\Http\Controllers\Api\LayoutApiController;
use Molitor\Cms\Http\Controllers\Api\MenuApiController;
use Molitor\Cms\Http\Controllers\Api\MenuItemApiController;
use Molitor\Cms\Http\Controllers\Api\PageApiController;
use Molitor\Cms\Http\Controllers\Api\PostApiController;
use Molitor\Cms\Http\Controllers\Api\PostGroupApiController;
use Molitor\Cms\Http\Controllers\Api\PostMetaApiController;

Route::prefix('api/cms')->middleware(['api'])->group(function () {
    Route::apiResource('pages', PageApiController::class);
    Route::get('/slug/{slug}', [PageApiController::class, 'getBySlug'])->name('cms.api.pages.getBySlug');
    Route::apiResource('posts', PostApiController::class);
    Route::get('/post/slug/{slug}', [PostApiController::class, 'getBySlug'])->name('cms.api.posts.getBySlug');
    Route::apiResource('regions', ContentRegionApiController::class);
    Route::apiResource('authors', AuthorApiController::class);
    Route::apiResource('post-groups', PostGroupApiController::class);
    Route::apiResource('post-metas', PostMetaApiController::class);
    Route::get('posts/{post}/metas', [PostMetaApiController::class, 'index'])->name('cms.api.posts.metas.index');
    Route::apiResource('menus', MenuApiController::class);
    Route::apiResource('menu-items', MenuItemApiController::class);
    Route::get('layouts', [LayoutApiController::class, 'index'])->name('cms.api.layouts.index');
});
