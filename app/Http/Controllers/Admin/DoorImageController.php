<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use Domain\Door\Queries\GetDoorByIdQuery;
use Domain\DoorImage\Queries\GetDoorImageByIdQuery;
use Domain\DoorImage\Commands\CreateDoorImageCommand;
use Domain\DoorImage\Commands\DeleteDoorImageCommand;
use Domain\DoorImage\Commands\UpdatePositionsDoorImageCommand;
use Domain\DoorImage\Commands\UpdateDoorImageCommand;
use App\Http\Controllers\Controller;
use App\Services\UploadImagesService;
use Domain\DoorImage\Requests\CreateDoorImageRequest;
use Domain\DoorImage\Requests\UpdateDoorImageRequest;
use Illuminate\Http\Request;

class DoorImageController extends Controller
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
     * @param int $id
     * @return array
     */
    public function index(int $id): array
    {
        $doors = $this->dispatch(new GetDoorByIdQuery($id));

        $viewFile = request()->get('isMobile') === 'true'
            ? 'admin.doors._images_box_mob'
            : 'admin.doors._images_box';

        return [
            'images' => view($viewFile, [
                'doors' => $doors
            ])->render()
        ];
    }

    /**
     * @param CreateDoorImageRequest $request
     * @param int $doorImage
     * @return string[]
     */
    public function store(CreateDoorImageRequest $request, int $doorImage): array
    {
        $image = $this->imagesService
            ->withThumb()
            ->setWidthThumb(173)
            ->setHeightThumb(157)
            ->upload($request, 'doors', $doorImage);

        $this->dispatch(new CreateDoorImageCommand($image));

        return [
            'message' => 'Данные сохранены успешно'
        ];
    }

    /**
     * @param int $id
     * @return string
     */
    public function edit(int $id): string
    {
        $image = $this->dispatch(new GetDoorImageByIdQuery($id));

        return view('admin.doors._image_popup', [
            'image' => $image
        ])->render();
    }

    /**
     * @param int $id
     * @param UpdateDoorImageRequest $request
     * @return array
     */
    public function update(int $id, UpdateDoorImageRequest $request): array
    {
        $this->dispatch(new UpdateDoorImageCommand($id, $request));

        $image = $this->dispatch(new GetDoorImageByIdQuery($id));
        $door = $this->dispatch(new GetDoorByIdQuery($image->Door_id));

        return [
            'images' => view('admin.doors._images_box', [
                'door' => $door
            ])->render(),
            'message' => 'Данные сохранены успешно'
        ];
    }

    /**
     * @param int $id
     * @return string[]
     */
    public function destroy(int $id): array
    {
        $this->dispatch(new DeleteDoorImageCommand($id));

        return [
            'message' => 'Изображение удалено успешно'
        ];
    }

    /**
     * @param Request $request
     * @return string[]
     */
    public function updatePositions(Request $request): array
    {
        $this->dispatch(new UpdatePositionsDoorImageCommand($request));

        return [
            'message' => 'Порядок изображений сохранён успешно'
        ];
    }
}
