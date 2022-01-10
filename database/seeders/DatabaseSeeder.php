<?php

namespace Database\Seeders;

use App\Models\BlogPost;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            User::factory()->count(2)->create(),
            BlogCategoriesTableSeeder::class,
            BlogPost::factory()->count(50)->create()
        ]);
    }
}
