<?php

declare(strict_types=1);

namespace Domain\Furniture\Queries;

use App\Models\Furniture;

/**
 * Class GetAllFurnitureQuery
 * @package Domain\Furniture\Queries
 */
class GetAllFurnitureQuery
{

    /**
     * Execute the job.
     */
    public function handle()
    {
        return Furniture::with(['collection', 'author', 'furnitureType'])->get();
    }
}
