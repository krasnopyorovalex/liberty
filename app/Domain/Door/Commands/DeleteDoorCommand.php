<?php

declare(strict_types=1);

namespace Domain\Door\Commands;

use Domain\Door\Queries\GetDoorByIdQuery;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Facades\Storage;

/**
 * Class DeleteDoorCommand
 * @package Domain\Door\Commands
 */
class DeleteDoorCommand
{
    use DispatchesJobs;

    /**
     * @var int
     */
    private int $id;

    /**
     * DeleteDoorCommand constructor.
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
        $Door = $this->dispatch(new GetDoorByIdQuery($this->id));

        if ($Door->image) {
            Storage::delete(str_replace('/storage/', '/public/', $Door->image));
        }

        if ($Door->image_mob) {
            Storage::delete(str_replace('/storage/', '/public/', $Door->image_mob));
        }

        return $Door->delete();
    }
}
