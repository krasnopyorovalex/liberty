<?php

declare(strict_types=1);

namespace Domain\DoorImage\Commands;

use Domain\DoorImage\Queries\GetDoorImageByIdQuery;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Storage;

/**
 * Class DeleteDoorImageCommand
 * @package Domain\DoorImage\Commands
 */
class DeleteDoorImageCommand
{
    use DispatchesJobs;

    private int $id;

    /**
     * DeleteDoorImageCommand constructor.
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
        $image = $this->dispatch(new GetDoorImageByIdQuery($this->id));

        Storage::delete([
            'public/interiors/' . $image->interior_id . '/' . $image->basename . '.' . $image->ext,
            'public/interiors/' . $image->interior_id . '/' . $image->basename . '_thumb.' . $image->ext
        ]);

        return $image->delete();
    }

}
