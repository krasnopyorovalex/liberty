<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Domain\FurnitureType\Commands\CreateFurnitureTypeCommand;
use Domain\FurnitureType\Commands\DeleteFurnitureTypeCommand;
use Domain\FurnitureType\Commands\UpdateFurnitureTypeCommand;
use Domain\FurnitureType\Queries\GetAllFurnitureTypesQuery;
use Domain\FurnitureType\Queries\GetFurnitureTypeByIdQuery;
use Domain\FurnitureType\Requests\CreateFurnitureTypeRequest;
use Domain\FurnitureType\Requests\UpdateFurnitureTypeRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

/**
 * Class FurnitureTypeController
 * @package App\Http\Controllers\Admin
 */
class FurnitureTypeController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $furnitureTypes = $this->dispatch(new GetAllFurnitureTypesQuery());

        return view('admin.furniture-types.index', [
            'furnitureTypes' => $furnitureTypes
        ]);
    }

    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('admin.furniture-types.create');
    }

    /**
     * @param CreateFurnitureTypeRequest $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(CreateFurnitureTypeRequest $request)
    {
        $this->dispatch(new CreateFurnitureTypeCommand($request));

        return redirect(route('admin.furniture_types.index'));
    }

    /**
     * @param int $id
     * @return Application|Factory|View
     */
    public function edit(int $id)
    {
        $furnitureType = $this->dispatch(new GetFurnitureTypeByIdQuery($id));

        return view('admin.furniture-types.edit', [
            'furnitureType' => $furnitureType
        ]);
    }

    /**
     * @param int $id
     * @param UpdateFurnitureTypeRequest $request
     * @return Application|RedirectResponse|Redirector
     */
    public function update(int $id, UpdateFurnitureTypeRequest $request)
    {
        $this->dispatch(new UpdateFurnitureTypeCommand($id, $request));

        return redirect(route('admin.furniture_types.index'));
    }

    /**
     * @param int $id
     * @return Application|RedirectResponse|Redirector
     */
    public function destroy(int $id)
    {
        $this->dispatch(new DeleteFurnitureTypeCommand($id));

        return redirect(route('admin.furniture_types.index'));
    }
}
