<?php

declare(strict_types=1);

namespace Domain\FurnitureAttribute\Queries;

use App\Models\FurnitureAttribute;

/**
 * Class GetAllFurnitureAttributesQuery
 * @package Domain\FurnitureAttribute\Queries
 */
class GetAllFurnitureAttributesQuery
{
    /**
     * Execute the job.
     */
    public function handle()
    {
        return FurnitureAttribute::with(['furnitureHasAttributes'])->get();
    }
}
