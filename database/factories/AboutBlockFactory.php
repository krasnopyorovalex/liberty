<?php

namespace Database\Factories;

use App\Models\AboutBlock;
use Illuminate\Database\Eloquent\Factories\Factory;

class AboutBlockFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AboutBlock::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'name' => 'качество',
            'text' => '<p>Уникальные поделки из натуральной древесины. Как известно, натуральное дерево всегда в моде. Современные дизайнеры то и дело в своих коллекциях возвращаются к этому материалу. Ведь дерево создает в интерьере особую теплую атмосферу. Мы собрали 20 замечательных элементов декора, которые вполне можно сделать своими руками.</p>'
        ];
    }
}
