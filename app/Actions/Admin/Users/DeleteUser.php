<?php

namespace App\Actions\Admin\Users;

use App\Models\User;
use Illuminate\Support\Facades\Gate;

class DeleteUser
{
    public function handle(User $user): void
    {
        Gate::authorize('delete', $user);

        $user->load('posts.media');
        foreach ($user->posts as $post) {
            $post->getMedia()->each(function ($medium) {
                $medium->delete();
            });
        }

        $user->delete();
    }
}
