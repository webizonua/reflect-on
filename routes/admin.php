<?php

use Inertia\Inertia;

Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::resource('pages', \App\Http\Controllers\Admin\PageController::class);
        Route::get('/', fn() => Inertia::render('Dashboard'))->name('dashboard');
    });

Route::post('/admin/media/upload', [\App\Http\Controllers\Admin\MediaController::class, 'upload'])
    ->middleware(['auth', 'admin'])
    ->name('admin.media.upload');