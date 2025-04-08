<?php

namespace App\Actions\Post;

use App\Models\Post;

class EditPostAction
{
    /**
     * Create a new class instance.
     */
    public function handle($postID, $postData)
    {
        $post = Post::findOrFail($postID);
        $post->title = $postData->title;
        $post->description = $postData->description;
        $post->price = $postData->price;
        $post->category_id = $postData->category_id;
        $post->city_id = $postData->city_id;
        $post->save();
        return $post;
    }
}
