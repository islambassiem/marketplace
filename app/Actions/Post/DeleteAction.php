<?php

namespace App\Actions\Post;

use App\Models\Post;

class DeleteAction
{
    /**
     * Create a new class instance.
     */
    public function handle(Post $post)
    {
        $post->delete();
    }
}
