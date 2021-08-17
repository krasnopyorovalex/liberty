<?php

namespace Database\Seeders;

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
        \App\Models\User::factory()->create();

        $this->call([
            PageSeeder::class,
            InteriorTypeSeeder::class,
            MenuSeeder::class,
            CollectionSeeder::class,
            FurnitureAttributeSeeder::class,
            AuthorSeeder::class,
            HowWeWorkSeeder::class,
            WhyChooseUsSeeder::class,
            FurnitureTypeSeeder::class,
            DoorAttributeSeeder::class,
        ]);
    }
}
