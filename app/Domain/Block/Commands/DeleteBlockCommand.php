<?php

declare(strict_types=1);

namespace Domain\Block\Commands;

use App\Models\Block;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class DeleteBlockCommand
 * @package Domain\Block\Commands
 */
class DeleteBlockCommand
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
        return Block::whereId($this->id)->delete();
    }
}
