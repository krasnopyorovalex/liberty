<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Models\DoorTexture;
use App\Services\UploadImagesService;
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
use Domain\Slider\Queries\GetAllSlidersQuery;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Storage;

/**
 * Class DoorController
 * @package App\Http\Controllers\Admin
 */
class DoorController extends Controller
{
    private UploadImagesService $imagesService;

    /**
     * @param UploadImagesService $imagesService
     */
    public function __construct(UploadImagesService $imagesService)
    {
        $this->imagesService = $imagesService;
    }

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
        $sliders = $this->dispatch(new GetAllSlidersQuery());
        $doors = $this->dispatch(new GetAllDoorsQuery());

        return view('admin.doors.create', [
            'doorAttributes' => $doorAttributes,
            'authors' => $authors,
            'sliders' => $sliders,
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
        $this->dispatch(new CreateDoorCommand($request, $this->imagesService));

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
        $sliders = $this->dispatch(new GetAllSlidersQuery());
        $doors = $this->dispatch(new GetAllDoorsQuery());

        return view('admin.doors.edit', [
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
        $this->dispatch(new UpdateDoorCommand($id, $request, $this->imagesService));

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
        $door = $this->dispatch(new GetDoorByIdQuery($id));

        if (\Storage::delete(str_replace('/storage/', '/public/', $door->image))) {
            \Storage::delete(str_replace('/storage/', '/public/', filename_replacer($door->image, UploadImagesService::DESKTOP_POSTFIX)));
            \Storage::delete(str_replace('/storage/', '/public/', filename_replacer($door->image, UploadImagesService::MOBILE_POSTFIX)));

            $door->image = '';
            $door->update();
        }

        return [
            'message' => '?????????????????????? ??????????????'
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
            'message' => '???????? ????????????'
        ];
    }

    public function textures(int $doorId)
    {
        foreach (request()->file('textures') as $file) {
            $path = Storage::putFile(sprintf('public/door-textures/%d', $doorId), $file);

            if ($path) {
                $doorTexture = new DoorTexture();
                $doorTexture->door_id = $doorId;
                $doorTexture->label = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $doorTexture->path = str_replace('public/', 'storage/', $path);

                $doorTexture->save();
            }
        }

        return redirect(route('admin.doors.edit', ['id' => $doorId, 'active' => 'textures']));
    }

    public function destroyTexture(int $id): array
    {
        $doorTexture = DoorTexture::findOrFail($id);

        if (\Storage::delete(str_replace('storage/', 'public/', $doorTexture->path))) {
            $doorTexture->delete();
        }

        return [
            'message' => '???????????????? ??????????????'
        ];
    }
}
