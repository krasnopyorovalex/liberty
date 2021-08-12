<?php

declare(strict_types=1);

namespace Domain\DoorAttribute\Commands;

use App\Http\Requests\Request;
use App\Models\DoorAttribute;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class CreateDoorAttributeCommand
 * @package Domain\DoorAttribute\Commands
 */
class CreateDoorAttributeCommand
{
    use DispatchesJobs;

    private Request $request;

    /**
     * CreateDoorAttributeCommand constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @return bool
     */
    public function handle(): bool
    {
        return (new DoorAttribute())->fill($this->request->validated())->save();
    }

}
