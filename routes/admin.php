<?php

use Inertia\Inertia;

Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/', fn() => Inertia::render('Dashboard'))->name('admin.dashboard');

    /*Route::resource('users', AdminUserController::class);
    Route::resource('blog', AdminBlogController::class);


    Route::get('/builder', fn() => Inertia::render('admin/pages/builder/editor'))->name('admin.builder');*/
});