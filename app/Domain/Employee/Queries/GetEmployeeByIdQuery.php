<?php

declare(strict_types=1);

namespace Domain\Employee\Queries;

use App\Models\Employee;

/**
 * Class GetEmployeeByIdQuery
 * @package Domain\Employee\Queries
 */
class GetEmployeeByIdQuery
{
    /**
     * @var int
     */
    private int $id;

    /**
     * GetEmployeeByIdQuery constructor.
     * @param int $id
     */
    public function __construct(int $id)
    {
        $this->id = $id;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        return Employee::with(['image'])->findOrFail($this->id);
    }
}
