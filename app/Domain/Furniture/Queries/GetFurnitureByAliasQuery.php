<?php

declare(strict_types=1);

namespace Domain\Furniture\Queries;

use App\Models\Furniture;

/**
 * Class GetFurnitureByAliasQuery
 * @package Domain\Furniture\Queries
 */
class GetFurnitureByAliasQuery
{
    /**
     * @var string
     */
    private string $alias;

    /**
     * GetFurnitureByAliasQuery constructor.
     * @param string $alias
     */
    public function __construct(string $alias)
    {
        $this->alias = $alias;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        return Furniture::with(['collection', 'furnitureAttributes', 'images'])->where('alias', $this->alias)->firstOrFail();
    }
}
