<?php

declare(strict_types=1);

namespace Domain\FurnitureInteriorSlider\Commands;

use Domain\FurnitureInteriorSlider\Queries\GetFurnitureInteriorSliderByIdQuery;
use App\Http\Requests\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class UpdateFurnitureInteriorSliderCommand
 * @package Domain\FurnitureInteriorSlider\Commands
 */
class UpdateFurnitureInteriorSliderCommand
{
    use DispatchesJobs;

    private Request $request;
    private int $id;

    /**
     * UpdateFurnitureInteriorSliderCommand constructor.
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
        $furnitureInteriorSlider = $this->dispatch(new GetFurnitureInteriorSliderByIdQuery($this->id));

        return $furnitureInteriorSlider->update($this->request->validated());
    }

}
