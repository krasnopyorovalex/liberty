<?php

declare(strict_types=1);

namespace Domain\Employee\Commands;

use Domain\Image\Commands\DeleteImageCommand;
use Domain\Image\Commands\UploadImageCommand;
use Domain\Employee\Queries\GetEmployeeByIdQuery;
use App\Events\RedirectDetected;
use App\Http\Requests\Request;
use App\Models\Employee;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class UpdateEmployeeCommand
 * @package Domain\Employee\Commands
 */
class UpdateEmployeeCommand
{

    use DispatchesJobs;

    private Request $request;
    private int $id;

    /**
     * UpdateEmployeeCommand constructor.
     * @param int $id
     * @param Request $request
     */
    public function __construct(int $id, Request $request)
    {
        $this->id = $id;
        $this->request = $request;
    }

    /**
     * @return bool
     */
    public function handle(): bool
    {
        $Employee = $this->dispatch(new GetEmployeeByIdQuery($this->id));
        $urlNew = $this->request->post('alias');

        if ($Employee->getOriginal('alias') != $urlNew) {
            event(new RedirectDetected($Employee->getOriginal('alias'), $urlNew));
        }

        if ($this->request->has('image')) {
            if ($Employee->image) {
                $this->dispatch(new DeleteImageCommand($Employee->image));
            }
            $this->dispatch(new UploadImageCommand($this->request, $Employee->id, Employee::class));
        }

        return $Employee->update($this->request->all());
    }

}
