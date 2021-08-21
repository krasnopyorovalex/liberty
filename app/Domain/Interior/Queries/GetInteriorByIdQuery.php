<?php

declare(strict_types=1);

namespace Domain\Interior\Queries;

use App\Models\Interior;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class GetInteriorByIdQuery
 * @package Domain\Interior\Queries
 */
class GetInteriorByIdQuery
{
    /**
     * @var int
     */
    private int $id;

    /**
     * GetInteriorByIdQuery constructor.
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
        return Interior::with(['images', 'author'])->findOrFail($this->id);
    }
}
