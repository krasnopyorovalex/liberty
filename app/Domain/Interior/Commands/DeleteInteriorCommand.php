<?php

declare(strict_types=1);

namespace Domain\Interior\Commands;

use Domain\Interior\Queries\GetInteriorByIdQuery;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Facades\Storage;

/**
 * Class DeleteInteriorCommand
 * @package Domain\Interior\Commands
 */
class DeleteInteriorCommand
{
    use DispatchesJobs;

    /**
     * @var int
     */
    private int $id;

    /**
     * DeleteInteriorCommand constructor.
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
        $salesLeader = $this->dispatch(new GetInteriorByIdQuery($this->id));

        if ($salesLeader->image) {
            Storage::delete(str_replace('/storage/', '/public/', $salesLeader->image));
        }

        if ($salesLeader->image_mob) {
            Storage::delete(str_replace('/storage/', '/public/', $salesLeader->image_mob));
        }

        return $salesLeader->delete();
    }
}
