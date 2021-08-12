<?php

declare(strict_types=1);

namespace Domain\FurnitureType\Queries;

use App\Models\FurnitureType;

/**
 * Class GetFurnitureTypeByIdQuery
 * @package Domain\FurnitureType\Queries
 */
class GetFurnitureTypeByIdQuery
{
    /**
     * @var int
     */
    private int $id;

    /**
     * GetFurnitureTypeByIdQuery constructor.
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
        return FurnitureType::findOrFail($this->id);
    }
}
