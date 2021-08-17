<?php

declare(strict_types=1);

namespace Domain\Employee\Queries;

use App\Models\Employee;

/**
 * Class GetAllEmployeesQuery
 * @package Domain\Employee\Queries
 */
class GetAllEmployeesQuery
{
    /**
     * Execute the job.
     */
    public function handle()
    {
        return Employee::orderBy('pos')->get();
    }
}
