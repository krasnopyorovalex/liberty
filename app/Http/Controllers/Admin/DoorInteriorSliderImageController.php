<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use Domain\DoorInteriorSlider\Queries\GetDoorInteriorSliderByIdQuery;
use Domain\DoorInteriorSliderImage\Commands\CreateDoorInteriorSliderImageCommand;
use Domain\DoorInteriorSliderImage\Commands\DeleteDoorInteriorSliderImageCommand;
use Domain\DoorInteriorSliderImage\Commands\UpdatePositionsDoorInteriorSliderImageCommand;
use Domain\DoorInteriorSliderImage\Commands\UpdateDoorInteriorSliderImageCommand;
use Domain\DoorInteriorSliderImage\Queries\GetDoorInteriorSliderImageByIdQuery;
use App\Http\Controllers\Controller;
use App\Services\UploadImagesService;
use Domain\DoorInteriorSliderImage\Requests\CreateDoorInteriorSliderImageRequest;
use Domain\DoorInteriorSliderImage\Requests\UpdateDoorInteriorSliderImageRequest;
use Illuminate\Http\Request;

/**
 * Class DoorInteriorSliderImageController
 * @package App\Http\Controllers\Admin
 */
class DoorInteriorSliderImageController extends Controller
{
    /**
     * @var UploadImagesService
     */
    private UploadImagesService $uploadDoorInteriorSliderImagesService;

    /**
     * DoorInteriorSliderImageController constructor.
     * @param UploadImagesService $uploadDoorInteriorSliderImagesService
     */
    public function __construct(UploadImagesService $uploadDoorInteriorSliderImagesService)
    {
        $this->uploadDoorInteriorSliderImagesService = $uploadDoorInteriorSliderImagesService;
    }

    /**
     * @param int $gallery
     * @return array
     */
    public function index(int $gallery): array
    {
        $doorInteriorSlider = $this->dispatch(new GetDoorInteriorSliderByIdQuery($gallery));

        $viewFile = request()->get('isMobile') === 'true'
            ? 'admin.door-interior-sliders._images_box_mob'
            : 'admin.door-interior-sliders._images_box';

        return [
            'images' => view($viewFile, [
                'doorInteriorSlider' => $doorInteriorSlider
            ])->render()
        ];
    }

    /**
     * @param CreateDoorInteriorSliderImageRequest $request
     * @param int $slider
     * @return string[]
     */
    public function store(CreateDoorInteriorSliderImageRequest $request, int $slider): array
    {
        $image = $this->uploadDoorInteriorSliderImagesService->withThumb()->upload($request, 'door-interior-slider', $slider);
        $this->dispatch(new CreateDoorInteriorSliderImageCommand($image));

        return [
            'message' => 'Данные сохранены успешно'
        ];
    }

    public function edit(int $id): string
    {
        $image = $this->dispatch(new GetDoorInteriorSliderImageByIdQuery($id));

        return view('admin.door-interior-sliders._image_popup', [
            'image' => $image
        ])->render();
    }

    /**
     * @param int $id
     * @param UpdateDoorInteriorSliderImageRequest $request
     * @return array
     */
    public function update(int $id, UpdateDoorInteriorSliderImageRequest $request): array
    {
        $this->dispatch(new UpdateDoorInteriorSliderImageCommand($id, $request));

        $image = $this->dispatch(new GetDoorInteriorSliderImageByIdQuery($id));
        $doorInteriorSlider = $this->dispatch(new GetDoorInteriorSliderByIdQuery($image->door_interior_slider_id));

        return [
            'images' => view('admin.door-interior-sliders._images_box', [
                'doorInteriorSlider' => $doorInteriorSlider
            ])->render(),
            'message' => 'Данные сохранены успешно'
        ];
    }

    public function destroy(int $id): array
    {
        $this->dispatch(new DeleteDoorInteriorSliderImageCommand($id));

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
        $this->dispatch(new UpdatePositionsDoorInteriorSliderImageCommand($request));

        return [
            'message' => 'Порядок изображений сохранён успешно'
        ];
    }
}
