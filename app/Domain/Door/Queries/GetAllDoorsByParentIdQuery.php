<?php

declare(strict_types=1);

namespace Domain\Door\Queries;

use App\Models\Door;

/**
 * Class GetAllDoorsByParentIdQuery
 * @package Domain\Door\Queries
 */
class GetAllDoorsByParentIdQuery
{
    private int $parentId;

    public function __construct(int $parentId)
    {
        $this->parentId = $parentId;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        return Door::with(['author', 'doorInteriorSlider'])->where('parent_id', $this->parentId)->get();
    }
}
