<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\FurnitureType;
use Illuminate\Database\Seeder;

class FurnitureTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        FurnitureType::factory()
            ->count(1)
            ->create();

        FurnitureType::factory()->create(['name' => 'Тумбы']);
        FurnitureType::factory()->create(['name' => 'Шкафы']);
        FurnitureType::factory()->create(['name' => 'Столы']);
    }
}
