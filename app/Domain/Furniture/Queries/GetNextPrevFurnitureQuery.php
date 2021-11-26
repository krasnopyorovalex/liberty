<?php

declare(strict_types=1);

namespace Domain\Furniture\Queries;

use App\Domain\Furniture\Dto\NextPrevDto;
use App\Models\Furniture;

class GetNextPrevFurnitureQuery
{
    private Furniture $furniture;

    /**
     * @param Furniture $furniture
     */
    public function __construct(Furniture $furniture)
    {
        $this->furniture = $furniture;
    }

    /**
     * @return NextPrevDto
     */
    public function handle(): NextPrevDto
    {
        $nextPrevDto = new NextPrevDto();

        $nextPrevDto->prev = Furniture::where('id', '>', $this->furniture->id)
            ->where('collection_id', $this->furniture->collection_id)
            ->orderBy('id','asc')
            ->first();

        if (!$nextPrevDto->prev) {
            $nextPrevDto->prev = Furniture::where('collection_id', $this->furniture->collection_id)
                ->orderBy('id','asc')
                ->first();
        }

        $nextPrevDto->next = Furniture::where('id', '<', $this->furniture->id)
            ->where('collection_id', $this->furniture->collection_id)
            ->orderBy('id','desc')
            ->first();

        if (!$nextPrevDto->next) {
            $nextPrevDto->next = Furniture::where('collection_id', $this->furniture->collection_id)
                ->orderBy('id','desc')
                ->first();
        }

        return $nextPrevDto;
    }
}
