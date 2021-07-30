<?php

declare(strict_types=1);

namespace Domain\Collection\Commands;

use Domain\Collection\Queries\GetSalesLeaderByIdQuery;
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
        $salesLeader = $this->dispatch(new GetSalesLeaderByIdQuery($this->id));

        if ($salesLeader->image) {
            Storage::delete(str_replace('/storage/', '/public/', $salesLeader->image));
        }

        if ($salesLeader->image_mob) {
            Storage::delete(str_replace('/storage/', '/public/', $salesLeader->image_mob));
        }

        return $salesLeader->delete();
    }
}
