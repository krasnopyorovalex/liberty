<?php

declare(strict_types=1);

namespace Domain\FurnitureInteriorSliderImage\Queries;

use App\Models\FurnitureInteriorSliderImage;

/**
 * Class GetFurnitureInteriorSliderImageByIdQuery
 * @package Domain\FurnitureInteriorSliderImage\Queries
 */
class GetFurnitureInteriorSliderImageByIdQuery
{
    /**
     * @var int
     */
    private int $id;

    /**
     * GetFurnitureInteriorSliderImageByIdQuery constructor.
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
        return FurnitureInteriorSliderImage::findOrFail($this->id);
    }
}
