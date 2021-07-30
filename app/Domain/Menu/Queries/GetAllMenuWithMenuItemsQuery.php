<?php

namespace Domain\Menu\Queries;

use App\Models\Menu;

/**
 * Class GetAllMenuWithMenuItemsQuery
 * @package Domain\Menu\Queries
 */
class GetAllMenuWithMenuItemsQuery
{
    /**
     * Execute the job.
     */
    public function handle()
    {
        return Menu::with(['menuItems' => function ($query) {
            return $query->where('parent_id', null)->orderBy('pos')->with(['menuItems' => function ($query) {
                return $query->orderBy('pos')->with(['menuItems']);
            }]);
        }])->get();
    }
}
