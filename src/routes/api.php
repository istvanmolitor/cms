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

Route::prefix('api/cms')->middleware(['api', 'auth:sanctum'])->group(function () {
    Route::apiResource('pages', PageApiController::class)->middleware('permission:cms_page');
    Route::get('/slug/{slug}', [PageApiController::class, 'getBySlug'])->name('cms.api.pages.getBySlug')->middleware('permission:cms_page');

    Route::apiResource('posts', PostApiController::class)->middleware('permission:cms_post');
    Route::get('/post/slug/{slug}', [PostApiController::class, 'getBySlug'])->name('cms.api.posts.getBySlug')->middleware('permission:cms_post');

    Route::apiResource('regions', ContentRegionApiController::class)->middleware('permission:cms_region');
    Route::apiResource('authors', AuthorApiController::class)->middleware('permission:cms_author');

    Route::apiResource('post-groups', PostGroupApiController::class)->middleware('permission:cms_post');
    Route::apiResource('post-metas', PostMetaApiController::class)->middleware('permission:cms_post');
    Route::get('posts/{post}/metas', [PostMetaApiController::class, 'index'])->name('cms.api.posts.metas.index')->middleware('permission:cms_post');

    Route::apiResource('menus', MenuApiController::class)->middleware('permission:cms_menu');
    Route::apiResource('menu-items', MenuItemApiController::class)->middleware('permission:cms_menu');

    Route::get('layouts', [LayoutApiController::class, 'index'])->name('cms.api.layouts.index')->middleware('permission:cms_page');
});
