<?php

declare(strict_types=1);

namespace Domain\DoorImage\Commands;

use Domain\DoorImage\Queries\GetDoorImageByIdQuery;
use App\Http\Requests\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class UpdateDoorImageCommand
 * @package Domain\DoorImage\Commands
 */
class UpdateDoorImageCommand
{
    use DispatchesJobs;

    private Request $request;
    private int $id;

    /**
     * UpdateDoorImageCommand constructor.
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
        $image = $this->dispatch(new GetDoorImageByIdQuery($this->id));

        return $image->update($this->request->validated());
    }
}
