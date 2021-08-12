<?php

declare(strict_types=1);

namespace Domain\DoorAttribute\Queries;

use App\Models\DoorAttribute;

/**
 * Class GetDoorAttributeByIdQuery
 * @package Domain\DoorAttribute\Queries
 */
class GetDoorAttributeByIdQuery
{
    /**
     * @var int
     */
    private int $id;

    /**
     * GetDoorAttributeByIdQuery constructor.
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
        return DoorAttribute::findOrFail($this->id);
    }
}
