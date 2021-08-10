<?php

declare(strict_types=1);

namespace Domain\FurnitureAttribute\Queries;

use App\Models\FurnitureAttribute;

/**
 * Class GetFurnitureAttributeByIdQuery
 * @package Domain\FurnitureAttribute\Queries
 */
class GetFurnitureAttributeByIdQuery
{
    /**
     * @var int
     */
    private int $id;

    /**
     * GetFurnitureAttributeByIdQuery constructor.
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
        return FurnitureAttribute::findOrFail($this->id);
    }
}
