<?php

declare(strict_types=1);

namespace Domain\DoorAttribute\Commands;

use Domain\DoorAttribute\Queries\GetDoorAttributeByIdQuery;
use App\Http\Requests\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class UpdateDoorAttributeCommand
 * @package Domain\DoorAttribute\Commands
 */
class UpdateDoorAttributeCommand
{
    use DispatchesJobs;

    private Request $request;
    private int $id;

    /**
     * UpdateDoorAttributeCommand constructor.
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
        $DoorAttribute = $this->dispatch(new GetDoorAttributeByIdQuery($this->id));

        return $DoorAttribute->update($this->request->validated());
    }

}
