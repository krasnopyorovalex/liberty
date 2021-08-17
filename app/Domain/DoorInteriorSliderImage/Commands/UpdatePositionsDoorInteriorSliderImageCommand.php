<?php

declare(strict_types=1);

namespace Domain\DoorInteriorSliderImage\Commands;

use Domain\DoorInteriorSliderImage\Queries\GetDoorInteriorSliderImageByIdQuery;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;

/**
 * Class UpdatePositionsDoorInteriorSliderImageCommand
 * @package Domain\DoorInteriorSliderImage\Commands
 */
class UpdatePositionsDoorInteriorSliderImageCommand
{
    use DispatchesJobs;

    private Request $request;

    /**
     * UpdatePositionsDoorInteriorSliderImageCommand constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function handle(): void
    {
        $data = $this->request->post()['data'];

        if (is_array($data)) {
            foreach ($data as $position => $imageId) {
                $image = $this->dispatch(new GetDoorInteriorSliderImageByIdQuery((int) $imageId));
                $image->pos = $position;
                $image->update();
            }
        }
    }
}
