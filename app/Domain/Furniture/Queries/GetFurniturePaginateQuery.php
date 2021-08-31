<?php

declare(strict_types=1);

namespace Domain\Furniture\Queries;

use App\Models\Furniture;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Class GetAllFurnitureQuery
 * @package Domain\Furniture\Queries
 */
class GetFurniturePaginateQuery
{
    /**
     * Execute the job.
     */
    public function handle(): LengthAwarePaginator
    {
        $furnitureList = Furniture::with(['collection', 'author', 'furnitureType', 'furnitureInteriorSlider']);

        if (request()->has('type')) {
            $furnitureList->where('furniture_type_id', request()->get('type'));
        }

        return $furnitureList->paginate();
    }
}
