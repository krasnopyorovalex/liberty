<?php

declare(strict_types=1);

namespace Domain\FurnitureType\Commands;

use App\Models\FurnitureType;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class DeleteFurnitureTypeCommand
 * @package Domain\FurnitureType\Commands
 */
class DeleteFurnitureTypeCommand
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
        return FurnitureType::whereId($this->id)->delete();
    }
}
