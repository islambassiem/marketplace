<?php

use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\Users;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('dashboard', Dashboard::class)->name('admin.dashboard');

    Route::get('users', Users::class)->name('admin.users');
});
