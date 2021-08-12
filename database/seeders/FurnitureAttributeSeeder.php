<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\FurnitureAttribute;
use Illuminate\Database\Seeder;

class FurnitureAttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        FurnitureAttribute::factory()
            ->count(1)
            ->create();

        FurnitureAttribute::factory()->create([
            'name' => 'Отделка'
        ]);

        FurnitureAttribute::factory()->create([
            'name' => 'Материалы'
        ]);

        FurnitureAttribute::factory()->create([
            'name' => 'Полотно'
        ]);
    }
}
