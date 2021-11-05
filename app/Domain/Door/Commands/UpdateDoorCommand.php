<?php

declare(strict_types=1);

namespace Domain\Door\Commands;

use App\Services\UploadImagesService;
use Domain\Door\Queries\GetDoorByIdQuery;
use App\Events\RedirectDetected;
use App\Http\Requests\Request;
use App\Models\Door;
use Closure;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Facades\Storage;

/**
 * Class UpdateDoorCommand
 * @package Domain\Door\Commands
 */
class UpdateDoorCommand
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
        /** @var Door $door */
        $door = $this->dispatch(new GetDoorByIdQuery($this->id));
        $urlNew = $this->request->post('alias');

        if ($door->getOriginal('alias') != $urlNew) {
            event(new RedirectDetected($door->getOriginal('alias'), $urlNew));
        }

        if ($this->request->has('image')) {
            if ($door->image) {
                ($this->deleter)(str_replace('/storage/', '/public/', $door->image));
                ($this->deleter)(str_replace('/storage/', '/public/', filename_replacer($door->image, UploadImagesService::DESKTOP_POSTFIX)));
                ($this->deleter)(str_replace('/storage/', '/public/', filename_replacer($door->image, UploadImagesService::MOBILE_POSTFIX)));
            }

            $path = $this->request->file('image')->store(Door::STORE_PATH);
            $door->image = Storage::url($path);

            $this->imagesService->createDesktopImage($door->image, Door::WIDTH, Door::HEIGHT);
            $this->imagesService->createMobileImage($door->image, Door::WIDTH_MOBILE, Door::HEIGHT_MOBILE);
        }

        if ($this->request->hasFile('file')) {
            if ($door->file) {
                ($this->deleter)(str_replace('/storage/', '/public/', $door->file));
            }

            $path = $this->request->file('file')->store(Door::STORE_PATH);
            $door->file = Storage::url($path);
        }

        if ($this->request->has('doorAttributes')) {
            $door->doorAttributes()->detach();
            $door->attachDoorAttributes($this->request->post('doorAttributes'));
        }

        return $door->update($this->request->validated());
    }
}
