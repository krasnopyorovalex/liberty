<?php

declare(strict_types=1);

namespace Domain\Collection\Queries;

use App\Models\Collection;

/**
 * Class GetCollectionByIdQuery
 * @package Domain\Collection\Queries
 */
class GetCollectionByIdQuery
{
    /**
     * @var int
     */
    private int $id;

    /**
     * GetCollectionByIdQuery constructor.
     * @param int $id
     */
    public function __construct(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function handle()
    {
        return Collection::findOrFail($this->id);
    }
}
