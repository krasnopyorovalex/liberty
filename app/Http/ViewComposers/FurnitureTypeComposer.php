<?php

declare(strict_types=1);

namespace App\Http\ViewComposers;

use Domain\FurnitureType\Queries\GetAllFurnitureTypesQuery;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Bus\DispatchesJobs;

class FurnitureTypeComposer
{
    use DispatchesJobs;

    /**
     * @param View $view
     */
    public function compose(View $view)
    {
        /** @var Collection $collection */
        $furnitureTypes = $this->dispatch(new GetAllFurnitureTypesQuery());

        $view->with('furnitureTypes', $furnitureTypes);
    }
}
