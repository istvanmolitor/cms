<?php

use Illuminate\Support\Facades\Route;
use Molitor\Cms\Http\Controllers\PageController;

Route::get('/page/{slug}', [PageController::class, 'show'])->name('cms.page.show');

