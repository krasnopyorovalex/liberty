<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use Domain\AboutBlock\Commands\CreateAboutBlockCommand;
use Domain\AboutBlock\Commands\DeleteAboutBlockCommand;
use Domain\AboutBlock\Commands\UpdateAboutBlockCommand;
use Domain\AboutBlock\Queries\GetAllAboutBlockQuery;
use Domain\AboutBlock\Queries\GetAboutBlockByIdQuery;
use App\Http\Controllers\Controller;
use Domain\AboutBlock\Requests\CreateAboutBlockRequest;
use Domain\AboutBlock\Requests\UpdateAboutBlockRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

/**
 *
 */
class AboutBlockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $aboutBlocks = $this->dispatch(new GetAllAboutBlockQuery);

        return view('admin.about-blocks.index', [
            'aboutBlocks' => $aboutBlocks
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('admin.about-blocks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateAboutBlockRequest $request
     * @return RedirectResponse|Redirector
     */
    public function store(CreateAboutBlockRequest $request)
    {
        $this->dispatch(new CreateAboutBlockCommand($request));

        return redirect(route('admin.about_blocks.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Application|Factory|View
     */
    public function edit(int $id)
    {
        $aboutBlock = $this->dispatch(new GetAboutBlockByIdQuery($id));

        return view('admin.about-blocks.edit', [
            'aboutBlock' => $aboutBlock
        ]);
    }

    /**
     * @param int $id
     * @param UpdateAboutBlockRequest $request
     * @return RedirectResponse
     */
    public function update(int $id, UpdateAboutBlockRequest $request): RedirectResponse
    {
        $this->dispatch(new UpdateAboutBlockCommand($id, $request));

        return redirect(route('admin.about_blocks.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Application|Redirector|RedirectResponse
     */
    public function destroy(int $id)
    {
        $this->dispatch(new DeleteAboutBlockCommand($id));

        return redirect(route('admin.about_blocks.index'));
    }

    /**
     * @param int $id
     * @return string[]
     */
    public function destroyImage(int $id): array
    {
        $AboutBlock = $this->dispatch(new GetAboutBlockByIdQuery($id));

        if (\Storage::delete(str_replace('/storage/', '/public/', $AboutBlock->image))) {
            $AboutBlock->update(['image' => '']);
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
        $AboutBlock = $this->dispatch(new GetAboutBlockByIdQuery($id));

        if (\Storage::delete(str_replace('/storage/', '/public/', $AboutBlock->image_mob))) {
            $AboutBlock->update(['image_mob' => '']);
        }

        return [
            'message' => 'Изображение удалено'
        ];
    }
}
