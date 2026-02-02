<?php

use Illuminate\Support\Facades\Route;
use Molitor\Cms\Http\Controllers\Api\ContentRegionApiController;
use Molitor\Cms\Http\Controllers\Api\PageApiController;

Route::prefix('api/cms')->group(function () {
    Route::get('/pages', [PageApiController::class, 'index'])->name('cms.api.pages.index');
    Route::post('/pages', [PageApiController::class, 'store'])->name('cms.api.pages.store');
    Route::get('/pages/{id}', [PageApiController::class, 'show'])->name('cms.api.pages.show');
    Route::put('/pages/{id}', [PageApiController::class, 'update'])->name('cms.api.pages.update');
    Route::delete('/pages/{id}', [PageApiController::class, 'destroy'])->name('cms.api.pages.destroy');
    Route::get('/slug/{slug}', [PageApiController::class, 'getBySlug'])->name('cms.api.pages.getBySlug');

    Route::get('/regions', [ContentRegionApiController::class, 'index'])->name('cms.api.regions.index');
    Route::post('/regions', [ContentRegionApiController::class, 'store'])->name('cms.api.regions.store');
    Route::get('/regions/{id}', [ContentRegionApiController::class, 'show'])->name('cms.api.regions.show');
    Route::put('/regions/{id}', [ContentRegionApiController::class, 'update'])->name('cms.api.regions.update');
    Route::delete('/regions/{id}', [ContentRegionApiController::class, 'destroy'])->name('cms.api.regions.destroy');
});

