<?php

declare(strict_types=1);

namespace Domain\Door\Queries;

use App\Models\Door;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class GetDoorByIdQuery
 * @package Domain\Door\Queries
 */
class GetDoorByIdQuery
{
    /**
     * @var int
     */
    private int $id;

    /**
     * GetDoorByIdQuery constructor.
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
        return Door::with(['images', 'doorAttributes'])->findOrFail($this->id);
    }
}
