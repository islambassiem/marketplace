<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contact>
 */
class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = collect(User::all())->random();

        return [
            'user_id' => $user->id,
            'name' => User::find($user->id)->name,
            'email' => fake()->email(),
            'type' => fake()->randomElement(array_keys(\App\Models\Contact::TYPES)),
            'subject' => fake()->sentence(),
            'body' => fake()->paragraph(),
        ];
    }
}
