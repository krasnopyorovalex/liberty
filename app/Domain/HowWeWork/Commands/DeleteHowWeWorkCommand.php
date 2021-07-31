<?php

declare(strict_types=1);

namespace Domain\HowWeWork\Commands;

use Domain\HowWeWork\Queries\GetHowWeWorkByIdQuery;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class DeleteHowWeWorkCommand
 * @package Domain\HowWeWork\Commands
 */
class DeleteHowWeWorkCommand
{
    use DispatchesJobs;

    /**
     * @var int
     */
    private int $id;

    /**
     * DeleteHowWeWorkCommand constructor.
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
        $howWeWork = $this->dispatch(new GetHowWeWorkByIdQuery($this->id));

        return $howWeWork->delete();
    }
}
