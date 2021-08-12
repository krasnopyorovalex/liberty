<?php

namespace Database\Factories;

use App\Models\FurnitureType;
use Illuminate\Database\Eloquent\Factories\Factory;

class FurnitureTypeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = FurnitureType::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'name' => 'Комоды'
        ];
    }
}
