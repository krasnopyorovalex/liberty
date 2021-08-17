<?php

namespace Database\Factories;

use App\Models\DoorAttribute;
use Illuminate\Database\Eloquent\Factories\Factory;

class DoorAttributeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = DoorAttribute::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'name' => 'Артикул',
            'pos' => 0
        ];
    }
}
