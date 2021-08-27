<?php

declare(strict_types=1);

namespace Domain\Door\Queries;

use App\Models\Door;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;


class GetDoorsByIdQuery
{
    /**
     * @var Door
     */
    private Door $door;

    /**
     * GetDoorsByIdQuery constructor.
     * @param Door $door
     */
    public function __construct(Door $door)
    {
        $this->door = $door;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function handle()
    {
        return $this->door->related_doors
            ? Door::whereIn('id', $this->door->related_doors)->get()
            : collect([]);
    }
}
