<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FavotiteUser>
 */
class FavotiteUserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = collect(User::all())->random();
        $post = collect(Post::all())->random();

        return [
            'user_id' => $user->id,
            'post_id' => $post->id,
        ];
    }
}
