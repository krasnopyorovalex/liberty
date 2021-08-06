<?php

declare(strict_types=1);

namespace Domain\ForClient\Commands;

use Domain\ForClient\Queries\GetForClientByIdQuery;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class DeleteForClientCommand
 * @package Domain\ForClient\Commands
 */
class DeleteForClientCommand
{
    use DispatchesJobs;

    /**
     * @var int
     */
    private int $id;

    /**
     * DeleteForClientCommand constructor.
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
        $forClient = $this->dispatch(new GetForClientByIdQuery($this->id));

        return $forClient->delete();
    }
}
