<?php

namespace Database\Factories;

use App\Models\FurnitureAttribute;
use Illuminate\Database\Eloquent\Factories\Factory;

class FurnitureAttributeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = FurnitureAttribute::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'name' => 'Артикул'
        ];
    }
}
