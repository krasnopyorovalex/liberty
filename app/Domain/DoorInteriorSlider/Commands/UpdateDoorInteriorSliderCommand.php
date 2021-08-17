<?php

declare(strict_types=1);

namespace Domain\DoorInteriorSlider\Commands;

use Domain\DoorInteriorSlider\Queries\GetDoorInteriorSliderByIdQuery;
use App\Http\Requests\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class UpdateDoorInteriorSliderCommand
 * @package Domain\DoorInteriorSlider\Commands
 */
class UpdateDoorInteriorSliderCommand
{
    use DispatchesJobs;

    private Request $request;
    private int $id;

    /**
     * UpdateDoorInteriorSliderCommand constructor.
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
        $doorInteriorSlider = $this->dispatch(new GetDoorInteriorSliderByIdQuery($this->id));

        return $doorInteriorSlider->update($this->request->validated());
    }

}
