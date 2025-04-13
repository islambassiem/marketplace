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
        $post->title = $postData['title'];
        $post->description = $postData['description'];
        $post->price = $postData['price'];
        $post->category_id = $postData['category_id'];
        $post->city_id = $postData['city_id'];
        $post->save();

        if ($postData['photos'] !== null) {
            $length = config('app.configuration.MAX_UPLOAD_NUMNER') - count($post->media) <= 0 ? 0 : config('app.configuration.MAX_UPLOAD_NUMNER') - count($post->media);

            $photos = array_slice($postData['photos'], 0, $length);
            foreach ($photos as $image) {
                $this->insetImage($post, $image);
            }
        }

        return $post;
    }

    private function insetImage($post, $image)
    {
        $fileName = md5(rand().$image->getClientOriginalName());
        $post->addMedia($image)
            ->usingFileName($fileName.'.'.$image->getClientOriginalExtension())
            ->usingName($fileName)
            ->toMediaCollection();
    }
}
