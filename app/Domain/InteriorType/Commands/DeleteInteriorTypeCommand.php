<?php

declare(strict_types=1);

namespace Domain\InteriorType\Commands;

use App\Models\InteriorType;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class DeleteInteriorTypeCommand
 * @package Domain\InteriorType\Commands
 */
class DeleteInteriorTypeCommand
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
        return InteriorType::whereId($this->id)->delete();
    }
}
