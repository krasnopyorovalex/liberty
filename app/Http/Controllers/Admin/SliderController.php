<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use Domain\Slider\Commands\CreateSliderCommand;
use Domain\Slider\Commands\DeleteSliderCommand;
use Domain\Slider\Commands\UpdateSliderCommand;
use Domain\Slider\Queries\GetAllSlidersQuery;
use Domain\Slider\Queries\GetSliderByIdQuery;
use App\Http\Controllers\Controller;
use Domain\Slider\Requests\CreateSliderRequest;
use Domain\SliderImage\Requests\UpdateSliderImageRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

class SliderController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $sliders = $this->dispatch(new GetAllSlidersQuery());

        return view('admin.sliders.index', [
            'sliders' => $sliders
        ]);
    }

    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('admin.sliders.create');
    }

    /**
     * @param CreateSliderRequest $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(CreateSliderRequest $request)
    {
        $this->dispatch(new CreateSliderCommand($request));

        return redirect(route('admin.sliders.index'));
    }

    /**
     * @param int $id
     * @return Application|Factory|View
     */
    public function edit(int $id)
    {
        $slider = $this->dispatch(new GetSliderByIdQuery($id));

        return view('admin.sliders.edit', [
            'slider' => $slider
        ]);
    }

    /**
     * @param int $id
     * @param UpdateSliderImageRequest $request
     * @return Application|RedirectResponse|Redirector
     */
    public function update(int $id, UpdateSliderImageRequest $request)
    {
        $this->dispatch(new UpdateSliderCommand($id, $request));

        return redirect(route('admin.sliders.index'));
    }

    /**
     * @param int $id
     * @return Application|RedirectResponse|Redirector
     */
    public function destroy(int $id)
    {
        $this->dispatch(new DeleteSliderCommand($id));

        return redirect(route('admin.sliders.index'));
    }
}
