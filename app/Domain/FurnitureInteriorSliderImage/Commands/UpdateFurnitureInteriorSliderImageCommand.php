<?php

declare(strict_types=1);

namespace Domain\FurnitureInteriorSliderImage\Commands;

use Domain\FurnitureInteriorSliderImage\Queries\GetFurnitureInteriorSliderImageByIdQuery;
use App\Http\Requests\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class UpdateFurnitureInteriorSliderImageCommand
 * @package Domain\FurnitureInteriorSliderImage\Commands
 */
class UpdateFurnitureInteriorSliderImageCommand
{
    use DispatchesJobs;

    private Request $request;
    private int $id;

    /**
     * UpdateFurnitureInteriorSliderImageCommand constructor.
     * @param int $id
     * @param Request $request
     */
    public function __construct(int $id, Request $request)
    {
        $this->id = $id;
        $this->request = $request;
    }

    /**
     * @return bool
     */
    public function handle(): bool
    {
        $image = $this->dispatch(new GetFurnitureInteriorSliderImageByIdQuery($this->id));

        return $image->update($this->request->validated());
    }

}
