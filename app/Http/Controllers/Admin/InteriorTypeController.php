<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Domain\InteriorType\Commands\CreateInteriorTypeCommand;
use Domain\InteriorType\Commands\DeleteInteriorTypeCommand;
use Domain\InteriorType\Commands\UpdateInteriorTypeCommand;
use Domain\InteriorType\Queries\GetAllInteriorTypesQuery;
use Domain\InteriorType\Queries\GetInteriorTypeByIdQuery;
use Domain\InteriorType\Requests\CreateInteriorTypeRequest;
use Domain\InteriorType\Requests\UpdateInteriorTypeRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

/**
 * Class InteriorTypeController
 * @package App\Http\Controllers\Admin
 */
class InteriorTypeController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $interiorTypes = $this->dispatch(new GetAllInteriorTypesQuery());

        return view('admin.interior-types.index', [
            'interiorTypes' => $interiorTypes
        ]);
    }

    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('admin.interior-types.create');
    }

    /**
     * @param CreateInteriorTypeRequest $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(CreateInteriorTypeRequest $request)
    {
        $this->dispatch(new CreateInteriorTypeCommand($request));

        return redirect(route('admin.interior_types.index'));
    }

    /**
     * @param int $id
     * @return Application|Factory|View
     */
    public function edit(int $id)
    {
        $interiorType = $this->dispatch(new GetInteriorTypeByIdQuery($id));

        return view('admin.interior-types.edit', [
            'interiorType' => $interiorType
        ]);
    }

    /**
     * @param int $id
     * @param UpdateInteriorTypeRequest $request
     * @return Application|RedirectResponse|Redirector
     */
    public function update(int $id, UpdateInteriorTypeRequest $request)
    {
        $this->dispatch(new UpdateInteriorTypeCommand($id, $request));

        return redirect(route('admin.interior_types.index'));
    }

    /**
     * @param int $id
     * @return Application|RedirectResponse|Redirector
     */
    public function destroy(int $id)
    {
        $this->dispatch(new DeleteInteriorTypeCommand($id));

        return redirect(route('admin.interior_types.index'));
    }
}
