<?php

declare(strict_types=1);

namespace Domain\CollectionImage\Queries;

use App\Models\CollectionImage;

/**
 * Class GetAllCollectionImagesQuery
 * @package Domain\CollectionImage\Queries
 */
class GetAllCollectionImagesQuery
{
    /**
     * Execute the job.
     */
    public function handle()
    {
        return CollectionImage::all();
    }
}
