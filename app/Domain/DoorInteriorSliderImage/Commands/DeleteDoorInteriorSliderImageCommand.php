<?php

declare(strict_types=1);

namespace Domain\DoorInteriorSliderImage\Commands;

use Domain\DoorInteriorSliderImage\Queries\GetDoorInteriorSliderImageByIdQuery;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class DeleteDoorInteriorSliderImageCommand
 * @package Domain\DoorInteriorSliderImage\Commands
 */
class DeleteDoorInteriorSliderImageCommand
{
    use DispatchesJobs;

    private int $id;

    /**
     * DeleteDoorInteriorSliderImageCommand constructor.
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
        $image = $this->dispatch(new GetDoorInteriorSliderImageByIdQuery($this->id));

        \Storage::delete([
            'public/slider/' . $image->slider_id . '/' . $image->basename . '.' . $image->ext,
            'public/slider/' . $image->slider_id . '/' . $image->basename . '_thumb.' . $image->ext
        ]);

        return $image->delete();
    }

}
