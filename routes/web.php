<?php

use App\Livewire\Chat\Chat;
use App\Livewire\Chat\Index as ChatIndex;
use App\Livewire\Contact;
use App\Livewire\Dashboard;
use App\Livewire\Favorite\Index as Favorite;
use App\Livewire\Home;
use App\Livewire\Post\Create;
use App\Livewire\Post\Edit;
use App\Livewire\Post\Index;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', Dashboard::class)
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('/post/{post}', Index::class)->name('post');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile')->name('settings');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');

    Route::get('/create', Create::class)->name('post.create');
    Route::get('post/{post}/edit', Edit::class)->name('post.edit');

    Route::get('favorites', Favorite::class)->name('favorites.index');

    Route::get('contact', Contact::class)->name('contact');

    Route::get('chat', ChatIndex::class)->name('chat.index');
    Route::get('chat/{query}', Chat::class)->name('chat');
});

require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';

Route::get('seed', function () {
    ini_set('max_execution_time', 0);
    $path = storage_path('/app/public/photos/');
    $files = collect(preg_grep('/^([^.])/', scandir($path)));
    $posts = \App\Models\Post::all();
    foreach ($posts as $post) {
        $count = mt_rand(5, 10);
        for ($i = 0; $i <= $count; $i++) {
            $post->addMedia($path . $files->random())
                ->preservingOriginal()
                ->toMediaCollection();
        }
    }
})->middleware(['auth', 'admin']);


Route::get('/{slug?}', Home::class)->name('home');
