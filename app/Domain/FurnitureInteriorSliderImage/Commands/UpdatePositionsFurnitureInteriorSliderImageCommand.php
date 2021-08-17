<?php

declare(strict_types=1);

namespace Domain\FurnitureInteriorSliderImage\Commands;

use Domain\FurnitureInteriorSliderImage\Queries\GetFurnitureInteriorSliderImageByIdQuery;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;

/**
 * Class UpdatePositionsFurnitureInteriorSliderImageCommand
 * @package Domain\FurnitureInteriorSliderImage\Commands
 */
class UpdatePositionsFurnitureInteriorSliderImageCommand
{
    use DispatchesJobs;

    private Request $request;

    /**
     * UpdatePositionsFurnitureInteriorSliderImageCommand constructor.
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
                $image = $this->dispatch(new GetFurnitureInteriorSliderImageByIdQuery((int) $imageId));
                $image->pos = $position;
                $image->update();
            }
        }
    }
}
