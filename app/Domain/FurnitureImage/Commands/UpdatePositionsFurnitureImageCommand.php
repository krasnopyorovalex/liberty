<?php

declare(strict_types=1);

namespace Domain\FurnitureImage\Commands;

use Domain\FurnitureImage\Queries\GetFurnitureImageByIdQuery;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;

/**
 * Class UpdatePositionsFurnitureImageCommand
 * @package Domain\FurnitureImage\Commands
 */
class UpdatePositionsFurnitureImageCommand
{
    use DispatchesJobs;

    private Request $request;

    /**
     * UpdatePositionsFurnitureImageCommand constructor.
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
                $image = $this->dispatch(new GetFurnitureImageByIdQuery((int) $imageId));
                $image->pos = $position;
                $image->update();
            }
        }
    }
}
