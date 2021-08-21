<?php

namespace Database\Factories;

use App\Models\Page;
use Illuminate\Database\Eloquent\Factories\Factory;

class PageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Page::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'name' => 'Главная',
            'alias' => 'index',
            'title' => 'Фабрика дверей и мебели',
            'description' => 'Фабрика дверей и мебели',
            'template' => 'page.index'
        ];
    }
}
