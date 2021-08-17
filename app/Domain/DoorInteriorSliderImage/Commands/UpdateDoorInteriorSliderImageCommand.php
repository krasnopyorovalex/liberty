<?php

declare(strict_types=1);

namespace Domain\DoorInteriorSliderImage\Commands;

use Domain\DoorInteriorSliderImage\Queries\GetDoorInteriorSliderImageByIdQuery;
use App\Http\Requests\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class UpdateDoorInteriorSliderImageCommand
 * @package Domain\DoorInteriorSliderImage\Commands
 */
class UpdateDoorInteriorSliderImageCommand
{
    use DispatchesJobs;

    private Request $request;
    private int $id;

    /**
     * UpdateDoorInteriorSliderImageCommand constructor.
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
        $image = $this->dispatch(new GetDoorInteriorSliderImageByIdQuery($this->id));

        return $image->update($this->request->validated());
    }

}
