<?php

declare(strict_types=1);

namespace Domain\Furniture\Queries;

use App\Models\Furniture;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class GetFurnitureByIdQuery
 * @package Domain\Furniture\Queries
 */
class GetFurnitureByIdQuery
{
    /**
     * @var int
     */
    private int $id;

    /**
     * GetFurnitureByIdQuery constructor.
     * @param int $id
     */
    public function __construct(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return Builder|Builder[]|Collection|Model|null
     */
    public function handle()
    {
        return Furniture::with(['images', 'furnitureAttributes'])->findOrFail($this->id);
    }
}
