<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Collection;
use Illuminate\Database\Seeder;

class CollectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Collection::factory()
            ->count(1)
            ->create();

        Collection::factory()->create([
            'name' => 'Коллекция аккорд',
            'title' => 'Коллекция аккорд',
            'description' => 'Коллекция аккорд',
            'alias' => 'collection-accord'
        ]);

        Collection::factory()->create([
            'name' => 'Авторская мебель',
            'title' => 'Авторская мебель',
            'description' => 'Авторская мебель',
            'alias' => 'authors-furniture'
        ]);
    }
}
