<?php

use App\Livewire\Admin\Ads;
use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\Inbox\Index;
use App\Livewire\Admin\Inbox\Show;
use App\Livewire\Admin\Users;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('dashboard', Dashboard::class)->name('admin.dashboard');

    Route::get('users', Users::class)->name('admin.users');
    Route::get('ads', Ads::class)->name('admin.ads');
    Route::get('inbox', Index::class)->name('admin.inbox.index');
    Route::get('inbox/{contact}/show', Show::class)->name('admin.inbox.show');
});
