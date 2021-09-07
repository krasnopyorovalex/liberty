<?php

declare(strict_types=1);

namespace Domain\Furniture\Queries;

use App\Domain\Furniture\Dto\NextPrevDto;
use App\Models\Furniture;

class GetNextPrevFurnitureQuery
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
     * @return NextPrevDto
     */
    public function handle(): NextPrevDto
    {
        $nextPrevDto = new NextPrevDto();

        $nextPrevDto->next = Furniture::where('id', '>', $this->id)->orderBy('id','asc')->first();
        $nextPrevDto->prev = Furniture::where('id', '<', $this->id)->orderBy('id','desc')->first();

        return $nextPrevDto;
    }
}
