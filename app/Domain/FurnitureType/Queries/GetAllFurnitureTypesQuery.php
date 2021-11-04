<?php

declare(strict_types=1);

namespace Domain\FurnitureType\Queries;

use App\Models\FurnitureType;

/**
 * Class GetAllFurnitureTypesQuery
 * @package Domain\FurnitureType\Queries
 */
class GetAllFurnitureTypesQuery
{
    /**
     * Execute the job.
     */
    public function handle()
    {
        return FurnitureType::orderBy('name')->get();
    }
}
