<?php

use Illuminate\Support\Facades\Route;
use Molitor\Cms\Http\Controllers\Api\AuthorApiController;
use Molitor\Cms\Http\Controllers\Api\ContentRegionApiController;
use Molitor\Cms\Http\Controllers\Api\LayoutApiController;
use Molitor\Cms\Http\Controllers\Api\MenuApiController;
use Molitor\Cms\Http\Controllers\Api\PageApiController;
use Molitor\Cms\Http\Controllers\Api\PageGroupApiController;

Route::prefix('api/cms')->group(function () {
    Route::resource('pages', PageApiController::class);
    Route::get('/slug/{slug}', [PageApiController::class, 'getBySlug'])->name('cms.api.pages.getBySlug');
    Route::resource('regions', ContentRegionApiController::class);
    Route::resource('authors', AuthorApiController::class);
    Route::resource('page-groups', PageGroupApiController::class);
    Route::resource('menus', MenuApiController::class);
    Route::get('layouts', [LayoutApiController::class, 'index'])->name('cms.api.layouts.index');
});
