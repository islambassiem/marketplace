<?php

namespace App\Actions\Post;

use App\Http\Requests\CreatePostRequest;
use App\Models\Post;

class CreatePostAction
{
    /**
     * Create a new class instance.
     */
    public function handle($postData)
    {
       $post = auth()->user()->posts()->create($postData);
       return $post;
    }
}
