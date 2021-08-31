<?php

declare(strict_types=1);

namespace App\Http\ViewComposers;

use Domain\Employee\Queries\GetAllEmployeesQuery;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Bus\DispatchesJobs;

class EmployeeComposer
{
    use DispatchesJobs;

    /**
     * @param View $view
     */
    public function compose(View $view)
    {
        /** @var Collection $employees */
        $employees = $this->dispatch(new GetAllEmployeesQuery());

        $view->with('employees', $employees);
    }
}
