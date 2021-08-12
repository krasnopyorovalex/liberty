<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\WhyChooseUs;
use Illuminate\Database\Seeder;

class WhyChooseUsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        WhyChooseUs::factory()
            ->count(1)
            ->create();

        WhyChooseUs::factory()->create([
            'name' => 'Гарантия',
            'text' => '<p>Качество мебели оцениваются следующими<br/>
                    показателями: комфортность, эстетичность,<br/>
                    надежность, долговечность. На формирование<br/>
                    качества мебели оказывает влияние качество<br/>
                    исходных материалов, обработки, сборки, отделки.</p>'
        ]);

        WhyChooseUs::factory()->create([
            'name' => 'Надежность',
            'text' => '<p>Качество мебели оцениваются следующими<br/>
                    показателями: комфортность, эстетичность,<br/>
                    надежность, долговечность. На формирование<br/>
                    качества мебели оказывает влияние качество<br/>
                    исходных материалов, обработки, сборки, отделки.</p>'
        ]);
    }
}
