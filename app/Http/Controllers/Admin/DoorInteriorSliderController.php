<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use Domain\DoorInteriorSlider\Commands\UpdateDoorInteriorSliderCommand;
use Domain\DoorInteriorSlider\Queries\GetDoorInteriorSliderByIdQuery;
use App\Http\Controllers\Controller;
use Domain\DoorInteriorSlider\Requests\UpdateDoorInteriorSliderRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

class DoorInteriorSliderController extends Controller
{
    /**
     * @param int $id
     * @return Application|Factory|View
     */
    public function edit(int $id)
    {
        $doorInteriorSlider = $this->dispatch(new GetDoorInteriorSliderByIdQuery($id));

        return view('admin.door-interior-sliders.edit', [
            'doorInteriorSlider' => $doorInteriorSlider
        ]);
    }

    /**
     * @param int $id
     * @param UpdateDoorInteriorSliderRequest $request
     * @return Application|RedirectResponse|Redirector
     */
    public function update(int $id, UpdateDoorInteriorSliderRequest $request)
    {
        $this->dispatch(new UpdateDoorInteriorSliderCommand($id, $request));

        $doorInteriorSlider = $this->dispatch(new GetDoorInteriorSliderByIdQuery($id));

        if ($doorInteriorSlider->door->parent) {
            return redirect(route('admin.door_modifications.index', $doorInteriorSlider->door->parent));
        }

        return redirect(route('admin.doors.index'));
    }
}
