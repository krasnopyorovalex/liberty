<?php

declare(strict_types=1);

namespace Domain\DoorImage\Queries;

use App\Models\DoorImage;

/**
 * Class GetDoorImageByIdQuery
 * @package Domain\DoorImage\Queries
 */
class GetDoorImageByIdQuery
{
    /**
     * @var int
     */
    private int $id;

    /**
     * GetDoorImageByIdQuery constructor.
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
        return DoorImage::findOrFail($this->id);
    }
}
