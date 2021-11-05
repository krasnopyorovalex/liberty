<?php

declare(strict_types=1);

namespace Domain\Furniture\Commands;

use App\Services\UploadImagesService;
use Domain\Furniture\Queries\GetFurnitureByIdQuery;
use App\Events\RedirectDetected;
use App\Http\Requests\Request;
use App\Models\Furniture;
use Closure;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Facades\Storage;

/**
 * Class UpdateFurnitureCommand
 * @package Domain\Furniture\Commands
 */
class UpdateFurnitureCommand
{
    use DispatchesJobs;

    private Request $request;
    private int $id;
    private Closure $deleter;
    private UploadImagesService $imagesService;

    /**
     * @param int $id
     * @param Request $request
     * @param UploadImagesService $imagesService
     */
    public function __construct(int $id, Request $request, UploadImagesService $imagesService)
    {
        $this->id = $id;
        $this->request = $request;
        $this->imagesService = $imagesService;

        $this->deleter = static fn (string $path) => Storage::delete($path);
    }

    /**
     * @return bool
     */
    public function handle(): bool
    {
        /** @var Furniture $furniture */
        $furniture = $this->dispatch(new GetFurnitureByIdQuery($this->id));
        $urlNew = $this->request->post('alias');

        if ($furniture->getOriginal('alias') != $urlNew) {
            event(new RedirectDetected($furniture->getOriginal('alias'), $urlNew));
        }

        if ($this->request->has('image')) {
            if ($furniture->image) {
                ($this->deleter)(str_replace('/storage/', '/public/', $furniture->image));
                ($this->deleter)(str_replace('/storage/', '/public/', filename_replacer($furniture->image, UploadImagesService::DESKTOP_POSTFIX)));
                ($this->deleter)(str_replace('/storage/', '/public/', filename_replacer($furniture->image, UploadImagesService::MOBILE_POSTFIX)));
            }

            $path = $this->request->file('image')->store(Furniture::STORE_PATH);
            $furniture->image = Storage::url($path);

            $this->imagesService->createDesktopImage($furniture->image, Furniture::WIDTH, Furniture::HEIGHT);
            $this->imagesService->createMobileImage($furniture->image, Furniture::WIDTH_MOBILE, Furniture::HEIGHT_MOBILE);
        }

        if ($this->request->hasFile('file')) {
            if ($furniture->file) {
                ($this->deleter)(str_replace('/storage/', '/public/', $furniture->file));
            }

            $path = $this->request->file('file')->store(Furniture::STORE_PATH);
            $furniture->file = Storage::url($path);
        }

        if ($this->request->has('furnitureAttributes')) {
            $furniture->furnitureAttributes()->detach();
            $furniture->attachFurnitureAttributes($this->request->post('furnitureAttributes'));
        }

        return $furniture->update($this->request->validated());
    }
}
