<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\InteriorType;
use Illuminate\Database\Seeder;

class InteriorTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        InteriorType::factory()->create(['name' => 'Интерьеры']);
        InteriorType::factory()->create(['name' => 'Гостиные']);
        InteriorType::factory()->create(['name' => 'Кухни']);
        InteriorType::factory()->create(['name' => 'Спальни']);
        InteriorType::factory()->create(['name' => 'Гардеробные']);
        InteriorType::factory()->create(['name' => 'Лестницы']);
        InteriorType::factory()->create(['name' => 'Рестораны']);
        InteriorType::factory()->create(['name' => 'Выставки']);
    }
}
