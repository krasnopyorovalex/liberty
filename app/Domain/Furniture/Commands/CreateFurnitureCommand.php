<?php

declare(strict_types=1);

namespace Domain\Furniture\Commands;

use App\Http\Requests\Request;
use App\Models\Furniture;
use App\Services\UploadImagesService;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Facades\Storage;

/**
 * Class CreateFurnitureCommand
 * @package Domain\Furniture\Commands
 */
class CreateFurnitureCommand
{
    use DispatchesJobs;

    private Request $request;
    private UploadImagesService $imagesService;

    /**
     * @param Request $request
     * @param UploadImagesService $imagesService
     */
    public function __construct(Request $request, UploadImagesService $imagesService)
    {
        $this->request = $request;
        $this->imagesService = $imagesService;
    }

    /**
     * @return bool
     */
    public function handle(): bool
    {
        $furniture = new Furniture();
        $furniture->fill($this->request->validated());

        if ($this->request->hasFile('image')) {
            $path = $this->request->file('image')->store(Furniture::STORE_PATH);
            $furniture->image = Storage::url($path);

            $this->imagesService->createDesktopImage($furniture->image, Furniture::WIDTH, Furniture::HEIGHT);
            $this->imagesService->createMobileImage($furniture->image, Furniture::WIDTH_MOBILE, Furniture::HEIGHT_MOBILE);
        }

        if ($this->request->hasFile('file')) {
            $path = $this->request->file('file')->store(Furniture::STORE_PATH);
            $furniture->file = Storage::url($path);
        }

        $furniture->save();

        if ($this->request->has('furnitureAttributes')) {
            $furniture->attachFurnitureAttributes($this->request->post('furnitureAttributes'));
        }

        return true;
    }
}
