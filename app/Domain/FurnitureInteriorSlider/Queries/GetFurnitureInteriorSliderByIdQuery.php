<?php

declare(strict_types=1);

namespace Domain\FurnitureInteriorSlider\Queries;

use App\Models\FurnitureInteriorSlider;

/**
 * Class GetFurnitureInteriorSliderByIdQuery
 * @package Domain\Page\Queries
 */
class GetFurnitureInteriorSliderByIdQuery
{
    /**
     * @var int
     */
    private int $id;

    /**
     * GetFurnitureInteriorSliderByIdQuery constructor.
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
        return FurnitureInteriorSlider::with(['images'])->findOrFail($this->id);
    }
}
