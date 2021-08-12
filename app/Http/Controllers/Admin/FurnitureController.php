<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use Domain\Author\Queries\GetAllAuthorsQuery;
use Domain\Collection\Queries\GetAllCollectionsQuery;
use Domain\Furniture\Commands\CreateFurnitureCommand;
use Domain\Furniture\Commands\DeleteFurnitureCommand;
use Domain\Furniture\Commands\UpdateFurnitureCommand;
use Domain\Furniture\Queries\GetAllFurnitureQuery;
use Domain\Furniture\Queries\GetFurnitureByIdQuery;
use App\Http\Controllers\Controller;
use Domain\Furniture\Requests\CreateFurnitureRequest;
use Domain\Furniture\Requests\UpdateFurnitureRequest;
use Domain\FurnitureAttribute\Queries\GetAllFurnitureAttributesQuery;
use Domain\FurnitureType\Queries\GetAllFurnitureTypesQuery;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

/**
 * Class FurnitureController
 * @package App\Http\Controllers\Admin
 */
class FurnitureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $furniture = $this->dispatch(new GetAllFurnitureQuery());

        return view('admin.furniture.index', [
            'furnitureList' => $furniture
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $furnitureAttributes = $this->dispatch(new GetAllFurnitureAttributesQuery());
        $collections = $this->dispatch(new GetAllCollectionsQuery());
        $authors = $this->dispatch(new GetAllAuthorsQuery());
        $furnitureTypes = $this->dispatch(new GetAllFurnitureTypesQuery());

        return view('admin.furniture.create', [
            'furnitureAttributes' => $furnitureAttributes,
            'collections' => $collections,
            'authors' => $authors,
            'furnitureTypes' => $furnitureTypes
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateFurnitureRequest $request
     * @return RedirectResponse|Redirector
     */
    public function store(CreateFurnitureRequest $request)
    {
        $this->dispatch(new CreateFurnitureCommand($request));

        return redirect(route('admin.furniture.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Application|Factory|View
     */
    public function edit(int $id)
    {
        $furniture = $this->dispatch(new GetFurnitureByIdQuery($id));
        $furnitureAttributes = $this->dispatch(new GetAllFurnitureAttributesQuery());
        $collections = $this->dispatch(new GetAllCollectionsQuery());
        $authors = $this->dispatch(new GetAllAuthorsQuery());
        $furnitureTypes = $this->dispatch(new GetAllFurnitureTypesQuery());

        return view('admin.furniture.edit', [
            'furniture' => $furniture,
            'furnitureAttributes' => $furnitureAttributes,
            'collections' => $collections,
            'authors' => $authors,
            'furnitureTypes' => $furnitureTypes
        ]);
    }

    /**
     * @param int $id
     * @param UpdateFurnitureRequest $request
     * @return RedirectResponse
     */
    public function update(int $id, UpdateFurnitureRequest $request): RedirectResponse
    {
        $this->dispatch(new UpdateFurnitureCommand($id, $request));

        return redirect(route('admin.furniture.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Application|Redirector|RedirectResponse
     */
    public function destroy(int $id)
    {
        $this->dispatch(new DeleteFurnitureCommand($id));

        return redirect(route('admin.furniture.index'));
    }

    /**
     * @param int $id
     * @return string[]
     */
    public function destroyImage(int $id): array
    {
        $furniture = $this->dispatch(new GetFurnitureByIdQuery($id));

        if (\Storage::delete(str_replace('/storage/', '/public/', $furniture->image))) {
            $furniture->update(['image' => '']);
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
        $furniture = $this->dispatch(new GetFurnitureByIdQuery($id));

        if (\Storage::delete(str_replace('/storage/', '/public/', $furniture->image_mob))) {
            $furniture->update(['image_mob' => '']);
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
        $furniture = $this->dispatch(new GetFurnitureByIdQuery($id));

        if (\Storage::delete(str_replace('/storage/', '/public/', $furniture->file))) {
            $furniture->update(['file' => '']);
        }

        return [
            'message' => 'Файл удалён'
        ];
    }
}
