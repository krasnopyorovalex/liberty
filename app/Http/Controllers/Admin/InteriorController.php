<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use Domain\Interior\Commands\CreateInteriorCommand;
use Domain\Interior\Commands\DeleteInteriorCommand;
use Domain\Interior\Commands\UpdateInteriorCommand;
use Domain\Interior\Queries\GetAllInteriorsQuery;
use Domain\Interior\Queries\GetInteriorByIdQuery;
use App\Http\Controllers\Controller;
use Domain\Interior\Requests\CreateInteriorRequest;
use Domain\Interior\Requests\UpdateInteriorRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

/**
 * Class InteriorController
 * @package App\Http\Controllers\Admin
 */
class InteriorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $interiors = $this->dispatch(new GetAllInteriorsQuery);

        return view('admin.interiors.index', [
            'interiors' => $interiors
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('admin.interiors.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateInteriorRequest $request
     * @return RedirectResponse|Redirector
     */
    public function store(CreateInteriorRequest $request)
    {
        $this->dispatch(new CreateInteriorCommand($request));

        return redirect(route('admin.interiors.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Application|Factory|View
     */
    public function edit(int $id)
    {
        $interior = $this->dispatch(new GetInteriorByIdQuery($id));

        return view('admin.interiors.edit', [
            'interior' => $interior
        ]);
    }

    /**
     * @param int $id
     * @param UpdateInteriorRequest $request
     * @return RedirectResponse
     */
    public function update(int $id, UpdateInteriorRequest $request): RedirectResponse
    {
        $this->dispatch(new UpdateInteriorCommand($id, $request));

        return redirect(route('admin.interiors.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Application|Redirector|RedirectResponse
     */
    public function destroy(int $id)
    {
        $this->dispatch(new DeleteInteriorCommand($id));

        return redirect(route('admin.interiors.index'));
    }

    /**
     * @param int $id
     * @return string[]
     */
    public function destroyImage(int $id): array
    {
        $interior = $this->dispatch(new GetInteriorByIdQuery($id));

        if (\Storage::delete(str_replace('/storage/', '/public/', $interior->image))) {
            $interior->update(['image' => '']);
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
        $interior = $this->dispatch(new GetInteriorByIdQuery($id));

        if (\Storage::delete(str_replace('/storage/', '/public/', $interior->image_mob))) {
            $interior->update(['image_mob' => '']);
        }

        return [
            'message' => 'Изображение удалено'
        ];
    }
}
