<?php

declare(strict_types=1);

namespace App\Http\ViewComposers;

use App\Models\Furniture;
use Domain\Furniture\Queries\GetFurniturePaginateQuery;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Bus\DispatchesJobs;

class FurnitureListComposer
{
    use DispatchesJobs;

    /**
     * @param View $view
     */
    public function compose(View $view)
    {
        /** @var Furniture $collection */
        $furnitureList = $this->dispatch(new GetFurniturePaginateQuery());

        $view->with('furnitureList', $furnitureList);
    }
}
