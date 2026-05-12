<?php

use Illuminate\Support\Facades\Route;
use Molitor\Cms\Http\Controllers\HomepageController;
use Molitor\Cms\Http\Controllers\PageController;
use Molitor\Cms\Http\Controllers\PageGroupController;

Route::get('/', [HomepageController::class, 'index'])->name('home');
Route::get('/page/{slug}', [PageController::class, 'show'])->name('page.show');
Route::get('/page-group/{slug}', [PageGroupController::class, 'show'])->name('page-group.show');
