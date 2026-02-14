<?php

use Illuminate\Support\Facades\Route;
use Molitor\Cms\Http\Controllers\Api\ContentRegionApiController;
use Molitor\Cms\Http\Controllers\Api\PageApiController;

Route::prefix('api/cms')->group(function () {
    Route::resource('pages', PageApiController::class);
    Route::get('/slug/{slug}', [PageApiController::class, 'getBySlug'])->name('cms.api.pages.getBySlug');

    Route::resource('regions', ContentRegionApiController::class);
});
