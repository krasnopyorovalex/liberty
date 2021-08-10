<?php

declare(strict_types=1);

namespace Domain\FurnitureImage\Queries;

use App\Models\FurnitureImage;

/**
 * Class GetFurnitureImageByIdQuery
 * @package Domain\FurnitureImage\Queries
 */
class GetFurnitureImageByIdQuery
{
    /**
     * @var int
     */
    private int $id;

    /**
     * GetFurnitureImageByIdQuery constructor.
     * @param int $id
     */
    public function __construct(int $id)
    {
        $this->id = $id;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        return FurnitureImage::findOrFail($this->id);
    }
}
