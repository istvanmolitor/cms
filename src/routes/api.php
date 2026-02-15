<?php

use Illuminate\Support\Facades\Route;
use Molitor\Cms\Http\Controllers\Api\AuthorApiController;
use Molitor\Cms\Http\Controllers\Api\ContentRegionApiController;
use Molitor\Cms\Http\Controllers\Api\PageApiController;
use Molitor\Cms\Http\Controllers\Api\PageGroupApiController;

Route::prefix('api/cms')->group(function () {
    Route::resource('pages', PageApiController::class);
    Route::post('/pages/{id}/approve-draft', [PageApiController::class, 'approveDraft'])->name('cms.api.pages.approveDraft');
    Route::post('/pages/{id}/reset-draft', [PageApiController::class, 'resetDraft'])->name('cms.api.pages.resetDraft');
    Route::get('/slug/{slug}', [PageApiController::class, 'getBySlug'])->name('cms.api.pages.getBySlug');

    Route::resource('regions', ContentRegionApiController::class);
    Route::post('/regions/{id}/approve-draft', [ContentRegionApiController::class, 'approveDraft'])->name('cms.api.regions.approveDraft');
    Route::post('/regions/{id}/reset-draft', [ContentRegionApiController::class, 'resetDraft'])->name('cms.api.regions.resetDraft');

    Route::resource('authors', AuthorApiController::class);
    Route::resource('page-groups', PageGroupApiController::class);
});
