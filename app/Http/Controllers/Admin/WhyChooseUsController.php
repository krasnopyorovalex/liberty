<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use Domain\WhyChooseUs\Commands\CreateWhyChooseUsCommand;
use Domain\WhyChooseUs\Commands\DeleteWhyChooseUsCommand;
use Domain\WhyChooseUs\Commands\UpdateWhyChooseUsCommand;
use Domain\WhyChooseUs\Queries\GetAllWhyChooseUsQuery;
use Domain\WhyChooseUs\Queries\GetWhyChooseUsByIdQuery;
use App\Http\Controllers\Controller;
use Domain\WhyChooseUs\Requests\CreateWhyChooseUsRequest;
use Domain\WhyChooseUs\Requests\UpdateWhyChooseUsRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

/**
 *
 */
class WhyChooseUsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $whyChooseUs = $this->dispatch(new GetAllWhyChooseUsQuery);

        return view('admin.why-choose-us.index', [
            'whyChooseUs' => $whyChooseUs
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('admin.why-choose-us.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateWhyChooseUsRequest $request
     * @return RedirectResponse|Redirector
     */
    public function store(CreateWhyChooseUsRequest $request)
    {
        $this->dispatch(new CreateWhyChooseUsCommand($request));

        return redirect(route('admin.why_choose_us.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Application|Factory|View
     */
    public function edit(int $id)
    {
        $whyChooseUs = $this->dispatch(new GetWhyChooseUsByIdQuery($id));

        return view('admin.why-choose-us.edit', [
            'whyChooseUs' => $whyChooseUs
        ]);
    }

    /**
     * @param int $id
     * @param UpdateWhyChooseUsRequest $request
     * @return RedirectResponse
     */
    public function update(int $id, UpdateWhyChooseUsRequest $request): RedirectResponse
    {
        $this->dispatch(new UpdateWhyChooseUsCommand($id, $request));

        return redirect(route('admin.why_choose_us.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Application|Redirector|RedirectResponse
     */
    public function destroy(int $id)
    {
        $this->dispatch(new DeleteWhyChooseUsCommand($id));

        return redirect(route('admin.why_choose_us.index'));
    }

    /**
     * @param int $id
     * @return string[]
     */
    public function destroyImage(int $id): array
    {
        $whyChooseUs = $this->dispatch(new GetWhyChooseUsByIdQuery($id));

        if (\Storage::delete(str_replace('/storage/', '/public/', $whyChooseUs->image))) {
            $whyChooseUs->update(['image' => '']);
        }

        return [
            'message' => 'Изображение удалено'
        ];
    }

    /**
     * @param int $id
     * @return string[]
     */
    public function destroyImageMob(int $id): array
    {
        $whyChooseUs = $this->dispatch(new GetWhyChooseUsByIdQuery($id));

        if (\Storage::delete(str_replace('/storage/', '/public/', $whyChooseUs->image_mob))) {
            $whyChooseUs->update(['image_mob' => '']);
        }

        return [
            'message' => 'Изображение удалено'
        ];
    }
}
