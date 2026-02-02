<?php

use Illuminate\Support\Facades\Route;
use Molitor\Cms\Http\Controllers\PageController;

Route::get('/page', [PageController::class, 'index'])->name('cms.index');
Route::get('/page/{slug}', [PageController::class, 'show'])->name('cms.page.show');

