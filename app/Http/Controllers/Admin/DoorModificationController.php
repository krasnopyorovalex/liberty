<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Models\Door;
use App\Models\DoorHasAttribute;
use App\Models\DoorTexture;
use App\Services\UploadImagesService;
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
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DoorModificationController extends Controller
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

        /*
         * к сожалению, времени не было реализовать нормально,
         * поэтому всю бизнес-логику копирования разместил в контроллере:(
         */
        $doorCopy = $door->replicate()->fill([
            'alias' => $door->alias . '-' . Str::random(4),
            'parent_id' => $door->id
        ]);

        if ($door->image) {
            $doorCopy->image = str_replace(pathinfo($door->image, PATHINFO_FILENAME), Str::random(40), $door->image);

            File::copy(
                storage_path('app'.str_replace('/storage/', '/public/', $door->image)),
                storage_path('app'.str_replace('/storage/', '/public/', $doorCopy->image))
            );

            $this->imagesService->createDesktopImage($doorCopy->image, Door::WIDTH, Door::HEIGHT);
            $this->imagesService->createMobileImage($doorCopy->image, Door::WIDTH_MOBILE, Door::HEIGHT_MOBILE);
        }

        if ($door->file) {
            $doorCopy->file = str_replace(pathinfo($door->file, PATHINFO_FILENAME), Str::random(40), $door->file);

            File::copy(
                storage_path('app'.str_replace('/storage/', '/public/', $door->file)),
                storage_path('app'.str_replace('/storage/', '/public/', $doorCopy->file))
            );
        }

        $doorCopy->save();

        if ($door->doorAttributes) {
            foreach ($door->doorAttributes as $attribute) {
                DoorHasAttribute::create([
                    'door_id' => $doorCopy->id,
                    'door_attribute_id' => (int) $attribute->id,
                    'value' => (string) $attribute->pivot->value
                ]);
            }
        }

        if ($door->textures) {
            foreach ($door->textures as $texture) {
                $texture->replicate()->fill([
                    'door_id' => $doorCopy->id,
                    'path' => preg_replace('#/\d/#', sprintf('/%d/', $doorCopy->id), $texture->path)
                ])->save();
            }

            File::copyDirectory(
                sprintf('%s/%d/', storage_path('app/public/door-textures'), $door->id),
                sprintf('%s/%d/', storage_path('app/public/door-textures'), $doorCopy->id)
            );
        }

        if ($door->images) {
            foreach ($door->images as $image) {
                $image->replicate()->fill(['door_id' => $doorCopy->id])->save();
            }

            File::copyDirectory(
                sprintf('%s/%d/', storage_path('app/public/doors'), $door->id),
                sprintf('%s/%d/', storage_path('app/public/doors'), $doorCopy->id)
            );
        }

        return view('admin.door-modifications.edit', [
            'doorAttributes' => $doorAttributes,
            'authors' => $authors,
            'sliders' => $sliders,
            'door' => $doorCopy->refresh(),
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
        $this->dispatch(new UpdateDoorCommand($id, $request, $this->imagesService));
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

        return redirect(route('admin.door_modifications.edit', ['id' => $doorId, 'active' => 'textures']));
    }

    public function destroyTexture(int $id): array
    {
        $doorTexture = DoorTexture::findOrFail($id);

        if (\Storage::delete(str_replace('storage/', 'public/', $doorTexture->path))) {
            $doorTexture->delete();
        }

        return [
            'message' => 'Текстура удалена'
        ];
    }
}
