<?php

use Inertia\Inertia;

Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::resource('pages', \App\Http\Controllers\Admin\PageController::class);
        Route::get('/', fn() => Inertia::render('Dashboard'))->name('dashboard');
    });