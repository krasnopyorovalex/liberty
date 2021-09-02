<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use Domain\Author\Queries\GetAllAuthorsQuery;
use Domain\Door\Commands\CreateDoorCommand;
use Domain\Door\Commands\DeleteDoorCommand;
use Domain\Door\Commands\UpdateDoorCommand;
use Domain\Door\Queries\GetAllDoorsByParentIdQuery;
use Domain\Door\Queries\GetAllDoorsQuery;
use Domain\Door\Queries\GetDoorByIdQuery;
use App\Http\Controllers\Controller;
use Domain\Door\Requests\CreateDoorRequest;
use Domain\Door\Requests\UpdateDoorRequest;
use Domain\DoorAttribute\Queries\GetAllDoorAttributesQuery;
use Domain\Slider\Queries\GetAllSlidersQuery;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

class DoorModificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param int $door
     * @return Application|Factory|View
     */
    public function index(int $door)
    {
        $doors = $this->dispatch(new GetAllDoorsByParentIdQuery($door));
        $door = $this->dispatch(new GetDoorByIdQuery($door));

        return view('admin.door-modifications.index', [
            'doors' => $doors,
            'door' => $door
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param int $door
     * @return Application|Factory|View
     */
    public function create(int $door)
    {
        $doorAttributes = $this->dispatch(new GetAllDoorAttributesQuery());
        $authors = $this->dispatch(new GetAllAuthorsQuery());
        $sliders = $this->dispatch(new GetAllSlidersQuery());
        $door = $this->dispatch(new GetDoorByIdQuery($door));
        $doors = $this->dispatch(new GetAllDoorsQuery());

        return view('admin.door-modifications.create', [
            'doorAttributes' => $doorAttributes,
            'authors' => $authors,
            'sliders' => $sliders,
            'door' => $door,
            'doors' => $doors
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateDoorRequest $request
     * @return RedirectResponse|Redirector
     */
    public function store(CreateDoorRequest $request)
    {
        $this->dispatch(new CreateDoorCommand($request));

        return redirect(route('admin.door_modifications.index', ['door' => $request->get('parent_id')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Application|Factory|View
     */
    public function edit(int $id)
    {
        $door = $this->dispatch(new GetDoorByIdQuery($id));
        $doorAttributes = $this->dispatch(new GetAllDoorAttributesQuery());
        $authors = $this->dispatch(new GetAllAuthorsQuery());
        $sliders = $this->dispatch(new GetAllSlidersQuery());
        $doors = $this->dispatch(new GetAllDoorsQuery());

        return view('admin.door-modifications.edit', [
            'door' => $door,
            'doorAttributes' => $doorAttributes,
            'authors' => $authors,
            'sliders' => $sliders,
            'doors' => $doors
        ]);
    }

    /**
     * @param int $id
     * @param UpdateDoorRequest $request
     * @return RedirectResponse
     */
    public function update(int $id, UpdateDoorRequest $request): RedirectResponse
    {
        $this->dispatch(new UpdateDoorCommand($id, $request));
        $door = $this->dispatch(new GetDoorByIdQuery($id));

        return redirect(route('admin.door_modifications.index', $door->parent));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Application|Redirector|RedirectResponse
     */
    public function destroy(int $id)
    {
        $door = $this->dispatch(new GetDoorByIdQuery($id));
        $this->dispatch(new DeleteDoorCommand($id));

        return redirect(route('admin.door_modifications.index', $door->parent));
    }

    /**
     * @param int $id
     * @return string[]
     */
    public function destroyImage(int $id): array
    {
        $door = $this->dispatch(new GetDoorByIdQuery($id));

        if (\Storage::delete(str_replace('/storage/', '/public/', $door->image))) {
            $door->image = '';
            $door->update();
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
        $door = $this->dispatch(new GetDoorByIdQuery($id));

        if (\Storage::delete(str_replace('/storage/', '/public/', $door->image_mob))) {
            $door->image_mob = '';
            $door->update();
        }

        return [
            'message' => 'Изображение удалено'
        ];
    }

    /**
     * @param int $id
     * @return string[]
     */
    public function destroyFile(int $id): array
    {
        $door = $this->dispatch(new GetDoorByIdQuery($id));

        if (\Storage::delete(str_replace('/storage/', '/public/', $door->file))) {
            $door->file = '';
            $door->update();
        }

        return [
            'message' => 'Файл удалён'
        ];
    }
}
