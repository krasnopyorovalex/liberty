<?php

declare(strict_types=1);

namespace Domain\DoorAttribute\Commands;

use App\Models\DoorAttribute;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class DeleteDoorAttributeCommand
 * @package Domain\DoorAttribute\Commands
 */
class DeleteDoorAttributeCommand
{
    use DispatchesJobs;

    /**
     * @var int
     */
    private int $id;

    /**
     * DeletePageCommand constructor.
     * @param int $id
     */
    public function __construct(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function handle()
    {
        return DoorAttribute::whereId($this->id)->delete();
    }
}
