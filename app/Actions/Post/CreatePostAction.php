<?php

namespace App\Actions\Post;

use App\Http\Requests\CreatePostRequest;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class CreatePostAction
{
    /**
     * Create a new class instance.
     */
    public function handle($postData): Post
    {
       $post = Auth::user()->posts()->create($postData);
       foreach ($postData['images'] as $image) {
        $fileName = md5(rand() . $image->getClientOriginalName());

        $post->addMedia($image)
            ->usingFileName($fileName . '.' . $image->getClientOriginalExtension())
            ->usingName($fileName)
            ->toMediaCollection(); // Optional: add collection name as parameter
    }
       return $post;
    }
}
