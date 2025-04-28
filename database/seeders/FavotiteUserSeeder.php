<?php

namespace Database\Seeders;

use App\Models\FavotiteUser;
use Illuminate\Database\Seeder;

class FavotiteUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        FavotiteUser::factory()
            ->count(1000)
            ->create();
    }
}
