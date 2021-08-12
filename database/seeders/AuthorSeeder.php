<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Author;
use Illuminate\Database\Seeder;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Author::factory()
            ->count(1)
            ->create();

        Author::factory()->create([
            'name' => 'Ольга Волкова',
            'alias' => 'olga-volkova',
            'title' => 'Ольга Волкова',
            'description' => 'Ольга Волкова',
            'text' => ''
        ]);

        Author::factory()->create([
            'name' => 'Александр Чичиканов',
            'alias' => 'aleksandr-chichikanov',
            'title' => 'Александр Чичиканов',
            'description' => 'Александр Чичиканов',
            'text' => ''
        ]);

        Author::factory()->create([
            'name' => 'Вишневский Андрей',
            'alias' => 'visnevskii-andrei',
            'title' => 'Вишневский Андрей',
            'description' => 'Вишневский Андрей',
            'text' => ''
        ]);

        Author::factory()->create([
            'name' => 'Янин Фёдор',
            'alias' => 'yanin-fyodor',
            'title' => 'Янин Фёдор',
            'description' => 'Янин Фёдор',
            'text' => ''
        ]);

        Author::factory()->create([
            'name' => 'Кондрашов Андрей',
            'alias' => 'kondrasov-andrei',
            'title' => 'Кондрашов Андрей',
            'description' => 'Кондрашов Андрей',
            'text' => ''
        ]);
    }
}
