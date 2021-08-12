<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Domain\DoorAttribute\Commands\CreateDoorAttributeCommand;
use Domain\DoorAttribute\Commands\DeleteDoorAttributeCommand;
use Domain\DoorAttribute\Commands\UpdateDoorAttributeCommand;
use Domain\DoorAttribute\Queries\GetAllDoorAttributesQuery;
use Domain\DoorAttribute\Queries\GetDoorAttributeByIdQuery;
use Domain\DoorAttribute\Requests\CreateDoorAttributeRequest;
use Domain\DoorAttribute\Requests\UpdateDoorAttributeRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

/**
 * Class DoorAttributeController
 * @package App\Http\Controllers\Admin
 */
class DoorAttributeController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $doorAttributes = $this->dispatch(new GetAllDoorAttributesQuery());

        return view('admin.door-attributes.index', [
            'doorAttributes' => $doorAttributes
        ]);
    }

    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('admin.door-attributes.create');
    }

    /**
     * @param CreateDoorAttributeRequest $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(CreateDoorAttributeRequest $request)
    {
        $this->dispatch(new CreateDoorAttributeCommand($request));

        return redirect(route('admin.door_attributes.index'));
    }

    /**
     * @param int $id
     * @return Application|Factory|View
     */
    public function edit(int $id)
    {
        $doorAttribute = $this->dispatch(new GetDoorAttributeByIdQuery($id));

        return view('admin.door-attributes.edit', [
            'doorAttribute' => $doorAttribute
        ]);
    }

    /**
     * @param int $id
     * @param UpdateDoorAttributeRequest $request
     * @return Application|RedirectResponse|Redirector
     */
    public function update(int $id, UpdateDoorAttributeRequest $request)
    {
        $this->dispatch(new UpdateDoorAttributeCommand($id, $request));

        return redirect(route('admin.door_attributes.index'));
    }

    /**
     * @param int $id
     * @return Application|RedirectResponse|Redirector
     */
    public function destroy(int $id)
    {
        $this->dispatch(new DeleteDoorAttributeCommand($id));

        return redirect(route('admin.door_attributes.index'));
    }
}
