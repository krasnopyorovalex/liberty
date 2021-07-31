<?php

declare(strict_types=1);

namespace Domain\Gallery\Queries;

use App\Models\InteriorImage;

/**
 * Class GetAllInteriorImagesQuery
 * @package Domain\Gallery\Queries
 */
class GetAllInteriorImagesQuery
{
    /**
     * Execute the job.
     */
    public function handle()
    {
        return InteriorImage::all();
    }
}
