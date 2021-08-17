<?php

declare(strict_types=1);

namespace Domain\Employee\Commands;

use Domain\Image\Commands\UploadImageCommand;
use App\Http\Requests\Request;
use App\Models\Employee;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class CreateEmployeeCommand
 * @package Domain\Employee\Commands
 */
class CreateEmployeeCommand
{
    use DispatchesJobs;

    private Request $request;

    /**
     * CreateEmployeeCommand constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @return bool
     */
    public function handle(): bool
    {
        $Employee = new Employee();
        $Employee->fill($this->request->validated());
        $Employee->save();

        if ($this->request->has('image')) {
            return $this->dispatch(new UploadImageCommand($this->request, $Employee->id, Employee::class));
        }

        return true;
    }

}
