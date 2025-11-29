<?php

use Illuminate\Support\Facades\Route;
use Molitor\Cms\Http\Controllers\Api\PageApiController;

Route::prefix('api/cms')->group(function () {
    Route::get('/pages', [PageApiController::class, 'index'])->name('cms.api.pages.index');
    Route::get('/pages/{slug}', [PageApiController::class, 'show'])->name('cms.api.pages.show');
});

