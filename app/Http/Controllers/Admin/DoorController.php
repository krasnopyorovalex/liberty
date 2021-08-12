<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use Domain\Author\Queries\GetAllAuthorsQuery;
use Domain\Door\Commands\CreateDoorCommand;
use Domain\Door\Commands\DeleteDoorCommand;
use Domain\Door\Commands\UpdateDoorCommand;
use Domain\Door\Queries\GetAllDoorsQuery;
use Domain\Door\Queries\GetDoorByIdQuery;
use App\Http\Controllers\Controller;
use Domain\Door\Requests\CreateDoorRequest;
use Domain\Door\Requests\UpdateDoorRequest;
use Domain\DoorAttribute\Queries\GetAllDoorAttributesQuery;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

/**
 * Class DoorController
 * @package App\Http\Controllers\Admin
 */
class DoorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $doors = $this->dispatch(new GetAllDoorsQuery());

        return view('admin.doors.index', [
            'doors' => $doors
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $doorAttributes = $this->dispatch(new GetAllDoorAttributesQuery());
        $authors = $this->dispatch(new GetAllAuthorsQuery());

        return view('admin.doors.create', [
            'doorAttributes' => $doorAttributes,
            'authors' => $authors
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

        return redirect(route('admin.doors.index'));
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

        return view('admin.doors.edit', [
            'door' => $door,
            'doorAttributes' => $doorAttributes,
            'authors' => $authors
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

        return redirect(route('admin.doors.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Application|Redirector|RedirectResponse
     */
    public function destroy(int $id)
    {
        $this->dispatch(new DeleteDoorCommand($id));

        return redirect(route('admin.doors.index'));
    }

    /**
     * @param int $id
     * @return string[]
     */
    public function destroyImage(int $id): array
    {
        $Door = $this->dispatch(new GetDoorByIdQuery($id));

        if (\Storage::delete(str_replace('/storage/', '/public/', $Door->image))) {
            $Door->update(['image' => '']);
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
        $Door = $this->dispatch(new GetDoorByIdQuery($id));

        if (\Storage::delete(str_replace('/storage/', '/public/', $Door->image_mob))) {
            $Door->update(['image_mob' => '']);
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
        $Door = $this->dispatch(new GetDoorByIdQuery($id));

        if (\Storage::delete(str_replace('/storage/', '/public/', $Door->file))) {
            $Door->update(['file' => '']);
        }

        return [
            'message' => 'Файл удалён'
        ];
    }
}
