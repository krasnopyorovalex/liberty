<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Page::factory()
            ->count(1)
            ->create();

        Page::factory()->create([
            'name' => 'О нас',
            'alias' => 'o-kompanii',
            'title' => 'О компании',
            'description' => 'О компании',
            'template' => 'page.about'
        ]);

        Page::factory()->create([
            'name' => 'Двери',
            'alias' => 'doors',
            'title' => 'Двери',
            'description' => 'Двери',
            'template' => 'page.doors'
        ]);

        Page::factory()->create([
            'name' => 'Мебель',
            'alias' => 'furniture',
            'title' => 'Мебель',
            'description' => 'Мебель',
            'template' => 'page.furniture'
        ]);

        Page::factory()->create([
            'name' => 'Портфолио',
            'alias' => 'portfolio',
            'title' => 'Портфолио',
            'description' => 'Портфолио',
            'template' => 'page.portfolio'
        ]);

        Page::factory()->create([
            'name' => 'Клиентам',
            'alias' => 'for-clients',
            'title' => 'Клиентам',
            'description' => 'Клиентам',
            'template' => 'page.for-clients'
        ]);

        Page::factory()->create([
            'name' => 'Контакты',
            'alias' => 'contacts',
            'title' => 'Контакты',
            'description' => 'Контакты',
            'template' => 'page.contacts'
        ]);
    }
}
