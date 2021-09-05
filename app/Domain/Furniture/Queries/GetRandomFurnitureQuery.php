<?php

declare(strict_types=1);

namespace Domain\Furniture\Queries;

use App\Models\Furniture;

class GetRandomFurnitureQuery
{
    private int $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        return Furniture::whereNotIn('id', [$this->id])->get();
    }
}
