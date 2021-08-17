<?php

declare(strict_types=1);

namespace Domain\Door\Queries;

use App\Models\Door;

/**
 * Class GetAllDoorQuery
 * @package Domain\Door\Queries
 */
class GetAllDoorsQuery
{
    /**
     * Execute the job.
     */
    public function handle()
    {
        return Door::with(['author', 'doorInteriorSlider'])
            ->where('parent_id', null)
            ->get();
    }
}
