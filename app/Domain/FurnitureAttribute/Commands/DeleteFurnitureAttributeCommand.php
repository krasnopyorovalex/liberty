<?php

declare(strict_types=1);

namespace Domain\FurnitureAttribute\Commands;

use App\Models\FurnitureAttribute;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class DeleteFurnitureAttributeCommand
 * @package Domain\FurnitureAttribute\Commands
 */
class DeleteFurnitureAttributeCommand
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
     * Execute the job.
     *
     * @return bool
     */
    public function handle(): bool
    {
        return FurnitureAttribute::whereId($this->id)->delete();
    }
}
