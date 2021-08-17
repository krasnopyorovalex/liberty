<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use Domain\FurnitureInteriorSlider\Commands\UpdateFurnitureInteriorSliderCommand;
use Domain\FurnitureInteriorSlider\Queries\GetFurnitureInteriorSliderByIdQuery;
use App\Http\Controllers\Controller;
use Domain\FurnitureInteriorSlider\Requests\UpdateFurnitureInteriorSliderRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

class FurnitureInteriorSliderController extends Controller
{
    /**
     * @param int $id
     * @return Application|Factory|View
     */
    public function edit(int $id)
    {
        $furnitureInteriorSlider = $this->dispatch(new GetFurnitureInteriorSliderByIdQuery($id));

        return view('admin.furniture-interior-sliders.edit', [
            'furnitureInteriorSlider' => $furnitureInteriorSlider
        ]);
    }

    /**
     * @param int $id
     * @param UpdateFurnitureInteriorSliderRequest $request
     * @return Application|RedirectResponse|Redirector
     */
    public function update(int $id, UpdateFurnitureInteriorSliderRequest $request)
    {
        $this->dispatch(new UpdateFurnitureInteriorSliderCommand($id, $request));

        return redirect(route('admin.furniture.index'));
    }
}
