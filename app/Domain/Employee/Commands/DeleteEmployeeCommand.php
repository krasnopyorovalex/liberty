<?php

declare(strict_types=1);

namespace Domain\Employee\Commands;

use Domain\Image\Commands\DeleteImageCommand;
use Domain\Employee\Queries\GetEmployeeByIdQuery;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class DeleteEmployeeCommand
 * @package Domain\Employee\Commands
 */
class DeleteEmployeeCommand
{

    use DispatchesJobs;

    /**
     * @var int
     */
    private $id;

    /**
     * DeleteEmployeeCommand constructor.
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
        $Employee = $this->dispatch(new GetEmployeeByIdQuery($this->id));

        if ($Employee->image) {
            $this->dispatch(new DeleteImageCommand($Employee->image));
        }

        return $Employee->delete();
    }

}
