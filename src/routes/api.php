<?php

use Illuminate\Support\Facades\Route;
use Molitor\Cms\Http\Controllers\Api\PageApiController;

Route::prefix('api/cms')->group(function () {
    Route::get('/pages', [PageApiController::class, 'index'])->name('cms.api.pages.index');
    Route::post('/pages', [PageApiController::class, 'store'])->name('cms.api.pages.store');
    Route::get('/pages/{id}', [PageApiController::class, 'show'])->name('cms.api.pages.show');
    Route::put('/pages/{id}', [PageApiController::class, 'update'])->name('cms.api.pages.update');
    Route::delete('/pages/{id}', [PageApiController::class, 'destroy'])->name('cms.api.pages.destroy');
    Route::get('/slug/{slug}', [PageApiController::class, 'getBySlug'])->name('cms.api.pages.getBySlug');
});

