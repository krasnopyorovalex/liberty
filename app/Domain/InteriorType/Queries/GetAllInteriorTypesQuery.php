<?php

declare(strict_types=1);

namespace Domain\InteriorType\Queries;

use App\Models\InteriorType;

/**
 * Class GetAllInteriorTypesQuery
 * @package Domain\InteriorType\Queries
 */
class GetAllInteriorTypesQuery
{
    /**
     * Execute the job.
     */
    public function handle()
    {
        return InteriorType::all();
    }
}
