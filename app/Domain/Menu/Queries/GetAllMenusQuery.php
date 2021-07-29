<?php

declare(strict_types=1);

namespace App\Domain\Menu\Queries;

use App\Models\Menu;

/**
 * Class GetAllMenusQuery
 * @package App\Domain\Menu\Queries
 */
class GetAllMenusQuery
{
    /**
     * Execute the job.
     */
    public function handle()
    {
        return Menu::all();
    }
}
