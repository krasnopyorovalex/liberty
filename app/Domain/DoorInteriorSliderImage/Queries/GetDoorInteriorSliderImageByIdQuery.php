<?php

declare(strict_types=1);

namespace Domain\DoorInteriorSliderImage\Queries;

use App\Models\DoorInteriorSliderImage;

/**
 * Class GetDoorInteriorSliderImageByIdQuery
 * @package Domain\DoorInteriorSliderImage\Queries
 */
class GetDoorInteriorSliderImageByIdQuery
{
    /**
     * @var int
     */
    private int $id;

    /**
     * GetDoorInteriorSliderImageByIdQuery constructor.
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
        return DoorInteriorSliderImage::findOrFail($this->id);
    }
}
