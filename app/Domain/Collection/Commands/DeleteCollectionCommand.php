<?php

declare(strict_types=1);

namespace Domain\Collection\Commands;

use Domain\Collection\Queries\GetCollectionByIdQuery;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Facades\Storage;

/**
 * Class DeleteCollectionCommand
 * @package Domain\Collection\Commands
 */
class DeleteCollectionCommand
{
    use DispatchesJobs;

    /**
     * @var int
     */
    private int $id;

    /**
     * DeleteCollectionCommand constructor.
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
        $collection = $this->dispatch(new GetCollectionByIdQuery($this->id));

        if ($collection->image) {
            Storage::delete(str_replace('/storage/', '/public/', $collection->image));
        }

        if ($collection->image_mob) {
            Storage::delete(str_replace('/storage/', '/public/', $collection->image_mob));
        }

        return $collection->delete();
    }
}
