<?php

declare(strict_types=1);

namespace Domain\Furniture\Queries;

use App\Models\Furniture;

class GetRandomFurnitureQuery
{
    private Furniture $furniture;

    public function __construct(Furniture $furniture)
    {
        $this->furniture = $furniture;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        return Furniture::whereNotIn('id', [$this->furniture->id])->where('collection_id', $this->furniture->collection_id)->get();
    }
}
