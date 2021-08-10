<?php

declare(strict_types=1);

namespace Domain\Tab\Commands;

use App\Models\Tab;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class DeleteTabCommand
 * @package Domain\Tab\Commands
 */
class DeleteTabCommand
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
        return Tab::whereId($this->id)->delete();
    }
}
