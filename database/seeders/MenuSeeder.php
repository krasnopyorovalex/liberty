<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\MenuItem;
use App\Models\Page;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menu = Menu::factory()->create(['name' => 'Верхнее меню', 'sys_name' => 'menu_header']);

        foreach (Page::all() as $page) {
            MenuItem::factory()->create([
                'name' => $page->name,
                'link' => $page->alias === 'index' ? '/' : '/' . $page->alias,
                'pos' => 0,
                'menu_id' => $menu->id
            ]);
        }
    }
}
