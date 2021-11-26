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
        $query = Interior::with(['interiorType']);

        if (request()->has('type')) {
            $query->where('interior_type_id', request('type'));
        }

        return $query->get();
    }
}
