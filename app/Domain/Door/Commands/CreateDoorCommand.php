<?php

declare(strict_types=1);

namespace Domain\Door\Commands;

use App\Http\Requests\Request;
use App\Models\Door;
use App\Services\UploadImagesService;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Facades\Storage;

/**
 * Class CreateDoorCommand
 * @package Domain\Door\Commands
 */
class CreateDoorCommand
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
        $door = new Door();
        $door->fill($this->request->validated());

        if ($this->request->hasFile('image')) {
            $path = $this->request->file('image')->store(Door::STORE_PATH);
            $door->image = Storage::url($path);

            $this->imagesService->createDesktopImage($door->image, Door::WIDTH, Door::HEIGHT);
            $this->imagesService->createMobileImage($door->image, Door::WIDTH_MOBILE, Door::HEIGHT_MOBILE);
        }

        if ($this->request->hasFile('file')) {
            $path = $this->request->file('file')->store(Door::STORE_PATH);
            $door->file = Storage::url($path);
        }

        $door->save();

        if ($this->request->has('doorAttributes')) {
            $door->attachDoorAttributes($this->request->post('doorAttributes'));
        }

        return true;
    }
}
