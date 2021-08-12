<?php

namespace Database\Factories;

use App\Models\HowWeWork;
use Illuminate\Database\Eloquent\Factories\Factory;

class HowWeWorkFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = HowWeWork::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'name' => 'Предварительный расчет',
            'text' => '<p>Если вы еще не определились с выбором дверей или мебели, Вы можете отправить нам свои пожелания и размеры, а наши менеджеры проконсультируют вас и сформируют предварительный расчет по проекту</p>'
        ];
    }
}
