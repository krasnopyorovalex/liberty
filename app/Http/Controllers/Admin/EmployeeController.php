<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Domain\Employee\Commands\UpdateEmployeePositionsCommand;
use Domain\Employee\Commands\CreateEmployeeCommand;
use Domain\Employee\Commands\DeleteEmployeeCommand;
use Domain\Employee\Commands\UpdateEmployeeCommand;
use Domain\Employee\Queries\GetAllEmployeesQuery;
use Domain\Employee\Queries\GetEmployeeByIdQuery;
use App\Http\Controllers\Controller;
use Domain\Employee\Requests\CreateEmployeeRequest;
use Domain\Employee\Requests\UpdateEmployeeRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

/**
 * Class EmployeeController
 * @package App\Http\Controllers\Admin
 */
class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $employees = $this->dispatch(new GetAllEmployeesQuery);

        return view('admin.employees.index', [
            'employees' => $employees
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('admin.employees.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateEmployeeRequest $request
     * @return RedirectResponse|Redirector
     */
    public function store(CreateEmployeeRequest $request)
    {
        $this->dispatch(new CreateEmployeeCommand($request));

        return redirect(route('admin.employees.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Application|Factory|View
     */
    public function edit(int $id)
    {
        $employee = $this->dispatch(new GetEmployeeByIdQuery($id));

        return view('admin.employees.edit', [
            'employee' => $employee
        ]);
    }

    /**
     * @param int $id
     * @param UpdateEmployeeRequest $request
     * @return RedirectResponse
     */
    public function update(int $id, UpdateEmployeeRequest $request): RedirectResponse
    {
        $this->dispatch(new UpdateEmployeeCommand($id, $request));

        return redirect(route('admin.employees.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Application|Redirector|RedirectResponse
     */
    public function destroy(int $id)
    {
        $this->dispatch(new DeleteEmployeeCommand($id));

        return redirect(route('admin.employees.index'));
    }

    public function positions(): bool
    {
        $this->dispatch(new UpdateEmployeePositionsCommand(request()->post('data')));

        return true;
    }
}
