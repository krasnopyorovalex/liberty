<?php

declare(strict_types=1);

namespace Domain\DoorImage\Queries;

use App\Models\DoorImage;

/**
 * Class GetAllDoorImagesQuery
 * @package Domain\DoorImage\Queries
 */
class GetAllDoorImagesQuery
{
    /**
     * Execute the job.
     */
    public function handle()
    {
        return DoorImage::all();
    }
}
