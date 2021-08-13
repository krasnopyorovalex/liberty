<?php

declare(strict_types=1);

namespace Domain\DoorImage\Commands;

use Domain\DoorImage\Queries\GetDoorImageByIdQuery;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;

/**
 * Class UpdatePositionsDoorImageCommand
 * @package Domain\DoorImage\Commands
 */
class UpdatePositionsDoorImageCommand
{
    use DispatchesJobs;

    private Request $request;

    /**
     * UpdatePositionsDoorImageCommand constructor.
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
                $image = $this->dispatch(new GetDoorImageByIdQuery((int) $imageId));
                $image->pos = $position;
                $image->update();
            }
        }
    }
}
