<?php

declare(strict_types=1);

namespace Domain\Furniture\Commands;

use Domain\Furniture\Queries\GetFurnitureByIdQuery;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Facades\Storage;

/**
 * Class DeleteFurnitureCommand
 * @package Domain\Furniture\Commands
 */
class DeleteFurnitureCommand
{
    use DispatchesJobs;

    /**
     * @var int
     */
    private int $id;

    /**
     * DeleteFurnitureCommand constructor.
     * @param int $id
     */
    public function __construct(int $id)
    {
        $this->id = $id;
    }

    /**
     * Execute the job.
     *
     * @return bool
     */
    public function handle(): bool
    {
        $furniture = $this->dispatch(new GetFurnitureByIdQuery($this->id));

        if ($furniture->image) {
            Storage::delete(str_replace('/storage/', '/public/', $furniture->image));
        }

        if ($furniture->image_mob) {
            Storage::delete(str_replace('/storage/', '/public/', $furniture->image_mob));
        }

        return $furniture->delete();
    }
}
