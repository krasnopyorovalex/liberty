<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Models\Furniture;
use App\Models\FurnitureHasAttributes;
use App\Models\FurnitureTexture;
use App\Services\UploadImagesService;
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
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * Class FurnitureController
 * @package App\Http\Controllers\Admin
 */
class FurnitureController extends Controller
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

        /*
         * к сожалению, времени не было реализовать нормально,
         * поэтому всю бизнес-логику копирования разместил в контроллере:(
         */
        if (request()->has('from')) {
            $furnitureOriginal = $this->dispatch(new GetFurnitureByIdQuery((int) request('from')));
            $furnitureCopy = $furnitureOriginal->replicate()->fill([
                'alias' => $furnitureOriginal->alias . '-' . Str::random(4)
            ]);

            if ($furnitureOriginal->image) {
                $furnitureCopy->image = str_replace(pathinfo($furnitureOriginal->image, PATHINFO_FILENAME), Str::random(40), $furnitureOriginal->image);

                File::copy(
                    storage_path('app'.str_replace('/storage/', '/public/', $furnitureOriginal->image)),
                    storage_path('app'.str_replace('/storage/', '/public/', $furnitureCopy->image))
                );

                $this->imagesService->createDesktopImage($furnitureCopy->image, Furniture::WIDTH, Furniture::HEIGHT);
                $this->imagesService->createMobileImage($furnitureCopy->image, Furniture::WIDTH_MOBILE, Furniture::HEIGHT_MOBILE);
            }

            if ($furnitureOriginal->file) {
                $furnitureCopy->file = str_replace(pathinfo($furnitureOriginal->file, PATHINFO_FILENAME), Str::random(40), $furnitureOriginal->file);

                File::copy(
                    storage_path('app'.str_replace('/storage/', '/public/', $furnitureOriginal->file)),
                    storage_path('app'.str_replace('/storage/', '/public/', $furnitureCopy->file))
                );
            }

            $furnitureCopy->save();

            if ($furnitureOriginal->furnitureAttributes) {
                foreach ($furnitureOriginal->furnitureAttributes as $attribute) {
                    FurnitureHasAttributes::create([
                        'furniture_id' => $furnitureCopy->id,
                        'furniture_attribute_id' => (int) $attribute->id,
                        'value' => (string) $attribute->pivot->value
                    ]);
                }
            }

            if ($furnitureOriginal->textures) {
                foreach ($furnitureOriginal->textures as $texture) {
                    $texture->replicate()->fill([
                        'furniture_id' => $furnitureCopy->id,
                        'path' => preg_replace('#/\d/#', sprintf('/%d/', $furnitureCopy->id), $texture->path)
                    ])->save();
                }

                File::copyDirectory(
                    sprintf('%s/%d/', storage_path('app/public/furniture-textures'), $furnitureOriginal->id),
                    sprintf('%s/%d/', storage_path('app/public/furniture-textures'), $furnitureCopy->id)
                );
            }

            if ($furnitureOriginal->images) {
                foreach ($furnitureOriginal->images as $image) {
                    $image->replicate()->fill(['furniture_id' => $furnitureCopy->id])->save();
                }

                File::copyDirectory(
                    sprintf('%s/%d/', storage_path('app/public/furniture'), $furnitureOriginal->id),
                    sprintf('%s/%d/', storage_path('app/public/furniture'), $furnitureCopy->id)
                );
            }

            return view('admin.furniture.edit', [
                'furnitureAttributes' => $furnitureAttributes,
                'collections' => $collections,
                'authors' => $authors,
                'furnitureTypes' => $furnitureTypes,
                'furniture' => $furnitureCopy->refresh()
            ]);
        }

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
        $this->dispatch(new CreateFurnitureCommand($request, $this->imagesService));

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
        $this->dispatch(new UpdateFurnitureCommand($id, $request, $this->imagesService));

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
            \Storage::delete(str_replace('/storage/', '/public/', filename_replacer($furniture->image, UploadImagesService::DESKTOP_POSTFIX)));
            \Storage::delete(str_replace('/storage/', '/public/', filename_replacer($furniture->image, UploadImagesService::MOBILE_POSTFIX)));

            $furniture->image = '';
            $furniture->update();
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
            $furniture->file = '';
            $furniture->update();
        }

        return [
            'message' => 'Файл удалён'
        ];
    }

    public function textures(int $furnitureId)
    {
        foreach (request()->file('textures') as $file) {
            $path = Storage::putFile(sprintf('public/furniture-textures/%d', $furnitureId), $file);

            if ($path) {
                $doorTexture = new FurnitureTexture();
                $doorTexture->furniture_id = $furnitureId;
                $doorTexture->label = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $doorTexture->path = str_replace('public/', 'storage/', $path);

                $doorTexture->save();
            }
        }

        return redirect(route('admin.furniture.edit', ['id' => $furnitureId, 'active' => 'textures']));
    }

    public function destroyTexture(int $id): array
    {
        $furnitureTexture = FurnitureTexture::findOrFail($id);

        if (Storage::delete(str_replace('storage/', 'public/', $furnitureTexture->path))) {
            $furnitureTexture->delete();
        }

        return [
            'message' => 'Текстура удалена'
        ];
    }
}
