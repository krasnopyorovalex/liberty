<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\DoorAttribute;
use Illuminate\Database\Seeder;

class DoorAttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DoorAttribute::factory()
            ->count(1)
            ->create();

        DoorAttribute::factory()->create([
            'name' => 'Материалы'
        ]);

        DoorAttribute::factory()->create([
            'name' => 'Полотно'
        ]);
    }
}
