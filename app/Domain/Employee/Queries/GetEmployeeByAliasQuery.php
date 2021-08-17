<?php

declare(strict_types=1);

namespace Domain\Employee\Queries;

use App\Models\Employee;

/**
 * Class GetEmployeeByAliasQuery
 * @package Domain\Employee\Queries
 */
class GetEmployeeByAliasQuery
{
    /**
     * @var string
     */
    private string $alias;

    /**
     * GetEmployeeByAliasQuery constructor.
     * @param string $alias
     */
    public function __construct(string $alias)
    {
        $this->alias = $alias;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        return Employee::where('alias', $this->alias)->where('is_published', '1')->firstOrFail();
    }
}
