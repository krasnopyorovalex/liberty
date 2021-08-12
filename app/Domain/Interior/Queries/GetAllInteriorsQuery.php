<?php

declare(strict_types=1);

namespace Domain\Interior\Queries;

use App\Models\Interior;

/**
 * Class GetAllInteriorsQuery
 * @package Domain\Interior\Queries
 */
class GetAllInteriorsQuery
{
    /**
     * Execute the job.
     */
    public function handle()
    {
        return Interior::with(['interiorType'])->get();
    }
}
