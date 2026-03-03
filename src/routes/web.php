<?php

use Illuminate\Support\Facades\Route;
use Molitor\Cms\Http\Controllers\PageController;
use Molitor\Cms\Http\Controllers\PageGroupController;

Route::get('/page', [PageController::class, 'index'])->name('cms.index');
Route::get('/page/{slug}', [PageController::class, 'show'])->name('cms.page.show');
Route::get('/page-group/{slug}', [PageGroupController::class, 'show'])->name('cms.page-group.show');

