<?php

declare(strict_types=1);

namespace Domain\FurnitureImage\Queries;

use App\Models\FurnitureImage;

/**
 * Class GetAllFurnitureImagesQuery
 * @package Domain\FurnitureImage\Queries
 */
class GetAllFurnitureImagesQuery
{
    /**
     * Execute the job.
     */
    public function handle()
    {
        return FurnitureImage::all();
    }
}
