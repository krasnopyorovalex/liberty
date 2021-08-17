<?php

declare(strict_types=1);

namespace Domain\DoorInteriorSlider\Queries;

use App\Models\DoorInteriorSlider;

/**
 * Class GetDoorInteriorSliderByIdQuery
 * @package Domain\Page\Queries
 */
class GetDoorInteriorSliderByIdQuery
{
    /**
     * @var int
     */
    private int $id;

    /**
     * GetDoorInteriorSliderByIdQuery constructor.
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
        return DoorInteriorSlider::with(['images', 'door.parent'])->findOrFail($this->id);
    }
}
