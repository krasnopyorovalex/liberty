<?php

namespace Database\Factories;

use App\Models\WhyChooseUs;
use Illuminate\Database\Eloquent\Factories\Factory;

class WhyChooseUsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = WhyChooseUs::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'name' => 'Качество',
            'text' => '<p>Качество мебели оцениваются следующими<br/>
                    показателями: комфортность, эстетичность,<br/>
                    надежность, долговечность. На формирование<br/>
                    качества мебели оказывает влияние качество<br/>
                    исходных материалов, обработки, сборки, отделки.</p>'
        ];
    }
}
