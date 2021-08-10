<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Domain\FurnitureAttribute\Commands\CreateFurnitureAttributeCommand;
use Domain\FurnitureAttribute\Commands\DeleteFurnitureAttributeCommand;
use Domain\FurnitureAttribute\Commands\UpdateFurnitureAttributeCommand;
use Domain\FurnitureAttribute\Queries\GetAllFurnitureAttributesQuery;
use Domain\FurnitureAttribute\Queries\GetFurnitureAttributeByIdQuery;
use Domain\FurnitureAttribute\Requests\CreateFurnitureAttributeRequest;
use Domain\FurnitureAttribute\Requests\UpdateFurnitureAttributeRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

/**
 * Class FurnitureAttributeController
 * @package App\Http\Controllers\Admin
 */
class FurnitureAttributeController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $furnitureAttributes = $this->dispatch(new GetAllFurnitureAttributesQuery());

        return view('admin.furniture-attributes.index', [
            'furnitureAttributes' => $furnitureAttributes
        ]);
    }

    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('admin.furniture-attributes.create');
    }

    /**
     * @param CreateFurnitureAttributeRequest $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(CreateFurnitureAttributeRequest $request)
    {
        $this->dispatch(new CreateFurnitureAttributeCommand($request));

        return redirect(route('admin.furniture_attributes.index'));
    }

    /**
     * @param int $id
     * @return Application|Factory|View
     */
    public function edit(int $id)
    {
        $furnitureAttribute = $this->dispatch(new GetFurnitureAttributeByIdQuery($id));

        return view('admin.furniture-attributes.edit', [
            'furnitureAttribute' => $furnitureAttribute
        ]);
    }

    /**
     * @param int $id
     * @param UpdateFurnitureAttributeRequest $request
     * @return Application|RedirectResponse|Redirector
     */
    public function update(int $id, UpdateFurnitureAttributeRequest $request)
    {
        $this->dispatch(new UpdateFurnitureAttributeCommand($id, $request));

        return redirect(route('admin.furniture_attributes.index'));
    }

    /**
     * @param int $id
     * @return Application|RedirectResponse|Redirector
     */
    public function destroy(int $id)
    {
        $this->dispatch(new DeleteFurnitureAttributeCommand($id));

        return redirect(route('admin.furniture_attributes.index'));
    }
}
