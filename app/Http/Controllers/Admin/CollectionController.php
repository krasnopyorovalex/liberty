<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use Domain\Collection\Commands\CreateCollectionCommand;
use Domain\Collection\Commands\DeleteCollectionCommand;
use Domain\Collection\Commands\UpdateCollectionCommand;
use Domain\Collection\Queries\GetAllCollectionsQuery;
use Domain\Collection\Queries\GetCollectionByIdQuery;
use App\Http\Controllers\Controller;
use Domain\Collection\Requests\CreateCollectionRequest;
use Domain\Collection\Requests\UpdateCollectionRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

/**
 * Class CollectionController
 * @package App\Http\Controllers\Admin
 */
class CollectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $collections = $this->dispatch(new GetAllCollectionsQuery);

        return view('admin.collections.index', [
            'collections' => $collections
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('admin.collections.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateCollectionRequest $request
     * @return RedirectResponse|Redirector
     */
    public function store(CreateCollectionRequest $request)
    {
        $this->dispatch(new CreateCollectionCommand($request));

        return redirect(route('admin.collections.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Application|Factory|View
     */
    public function edit(int $id)
    {
        $collection = $this->dispatch(new GetCollectionByIdQuery($id));

        return view('admin.collections.edit', [
            'collection' => $collection
        ]);
    }

    /**
     * @param int $id
     * @param UpdateCollectionRequest $request
     * @return RedirectResponse
     */
    public function update(int $id, UpdateCollectionRequest $request): RedirectResponse
    {
        $this->dispatch(new UpdateCollectionCommand($id, $request));

        return redirect(route('admin.collections.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Application|Redirector|RedirectResponse
     */
    public function destroy(int $id)
    {
        $this->dispatch(new DeleteCollectionCommand($id));

        return redirect(route('admin.collections.index'));
    }

    /**
     * @param int $id
     * @return string[]
     */
    public function destroyImage(int $id): array
    {
        $salesLeader = $this->dispatch(new GetCollectionByIdQuery($id));

        if (\Storage::delete(str_replace('/storage/', '/public/', $salesLeader->image))) {
            $salesLeader->update(['image' => '']);
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
        $salesLeader = $this->dispatch(new GetCollectionByIdQuery($id));

        if (\Storage::delete(str_replace('/storage/', '/public/', $salesLeader->image_mob))) {
            $salesLeader->update(['image_mob' => '']);
        }

        return [
            'message' => 'Изображение удалено'
        ];
    }
}
