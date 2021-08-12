<?php

declare(strict_types=1);

namespace Domain\DoorAttribute\Queries;

use App\Models\DoorAttribute;

/**
 * Class GetAllDoorAttributesQuery
 * @package Domain\DoorAttribute\Queries
 */
class GetAllDoorAttributesQuery
{
    /**
     * Execute the job.
     */
    public function handle()
    {
        return DoorAttribute::all();
    }
}
