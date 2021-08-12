<?php

declare(strict_types=1);

namespace Domain\InteriorType\Queries;

use App\Models\InteriorType;

/**
 * Class GetInteriorTypeByIdQuery
 * @package Domain\InteriorType\Queries
 */
class GetInteriorTypeByIdQuery
{
    /**
     * @var int
     */
    private int $id;

    /**
     * GetInteriorTypeByIdQuery constructor.
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
        return InteriorType::findOrFail($this->id);
    }
}
