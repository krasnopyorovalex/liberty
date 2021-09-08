<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Employee;
use Domain\Employee\Queries\GetEmployeeByAliasQuery;
use App\Services\CanonicalService;
use Illuminate\View\View;
use Illuminate\Contracts\View\Factory;
use Exception;

class EmployeeController extends Controller
{
    /**
     * @var CanonicalService
     */
    protected CanonicalService $canonicalService;

    /**
     * @param CanonicalService $canonicalService
     */
    public function __construct(CanonicalService $canonicalService)
    {
        $this->canonicalService = $canonicalService;
    }

    /**
     * @param string $alias
     * @return Factory|View
     */
    public function __invoke(string $alias)
    {
        /** @var $employee Employee*/
        $employee = $this->dispatch(new GetEmployeeByAliasQuery($alias));

        try {
            /** @var $Employee Employee*/
            $employee = $this->canonicalService->check($employee);

        } catch (Exception $exception) {
            $employee->text = $exception->getMessage();
        }

        return view('employee.index', ['employee' => $employee]);
    }
}
