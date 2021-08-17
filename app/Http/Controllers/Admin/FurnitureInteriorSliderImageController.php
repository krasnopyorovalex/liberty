<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use Domain\FurnitureInteriorSlider\Queries\GetFurnitureInteriorSliderByIdQuery;
use Domain\FurnitureInteriorSliderImage\Commands\CreateFurnitureInteriorSliderImageCommand;
use Domain\FurnitureInteriorSliderImage\Commands\DeleteFurnitureInteriorSliderImageCommand;
use Domain\FurnitureInteriorSliderImage\Commands\UpdatePositionsFurnitureInteriorSliderImageCommand;
use Domain\FurnitureInteriorSliderImage\Commands\UpdateFurnitureInteriorSliderImageCommand;
use Domain\FurnitureInteriorSliderImage\Queries\GetFurnitureInteriorSliderImageByIdQuery;
use App\Http\Controllers\Controller;
use App\Services\UploadImagesService;
use Domain\FurnitureInteriorSliderImage\Requests\CreateFurnitureInteriorSliderImageRequest;
use Domain\FurnitureInteriorSliderImage\Requests\UpdateFurnitureInteriorSliderImageRequest;
use Illuminate\Http\Request;

/**
 * Class FurnitureInteriorSliderImageController
 * @package App\Http\Controllers\Admin
 */
class FurnitureInteriorSliderImageController extends Controller
{
    /**
     * @var UploadImagesService
     */
    private UploadImagesService $uploadFurnitureInteriorSliderImagesService;

    /**
     * FurnitureInteriorSliderImageController constructor.
     * @param UploadImagesService $uploadFurnitureInteriorSliderImagesService
     */
    public function __construct(UploadImagesService $uploadFurnitureInteriorSliderImagesService)
    {
        $this->uploadFurnitureInteriorSliderImagesService = $uploadFurnitureInteriorSliderImagesService;
    }

    /**
     * @param int $gallery
     * @return array
     */
    public function index(int $gallery): array
    {
        $furnitureInteriorSlider = $this->dispatch(new GetFurnitureInteriorSliderByIdQuery($gallery));

        $viewFile = request()->get('isMobile') === 'true'
            ? 'admin.furniture-interior-sliders._images_box_mob'
            : 'admin.furniture-interior-sliders._images_box';

        return [
            'images' => view($viewFile, [
                'furnitureInteriorSlider' => $furnitureInteriorSlider
            ])->render()
        ];
    }

    /**
     * @param CreateFurnitureInteriorSliderImageRequest $request
     * @param int $slider
     * @return string[]
     */
    public function store(CreateFurnitureInteriorSliderImageRequest $request, int $slider): array
    {
        $image = $this->uploadFurnitureInteriorSliderImagesService->withThumb()->upload($request, 'furniture-interior-slider', $slider);
        $this->dispatch(new CreateFurnitureInteriorSliderImageCommand($image));

        return [
            'message' => 'Данные сохранены успешно'
        ];
    }

    public function edit(int $id): string
    {
        $image = $this->dispatch(new GetFurnitureInteriorSliderImageByIdQuery($id));

        return view('admin.furniture-interior-sliders._image_popup', [
            'image' => $image
        ])->render();
    }

    /**
     * @param int $id
     * @param UpdateFurnitureInteriorSliderImageRequest $request
     * @return array
     */
    public function update(int $id, UpdateFurnitureInteriorSliderImageRequest $request): array
    {
        $this->dispatch(new UpdateFurnitureInteriorSliderImageCommand($id, $request));

        $image = $this->dispatch(new GetFurnitureInteriorSliderImageByIdQuery($id));
        $furnitureInteriorSlider = $this->dispatch(new GetFurnitureInteriorSliderByIdQuery($image->furniture_interior_slider_id));

        return [
            'images' => view('admin.furniture-interior-sliders._images_box', [
                'furnitureInteriorSlider' => $furnitureInteriorSlider
            ])->render(),
            'message' => 'Данные сохранены успешно'
        ];
    }

    public function destroy(int $id): array
    {
        $this->dispatch(new DeleteFurnitureInteriorSliderImageCommand($id));

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
        $this->dispatch(new UpdatePositionsFurnitureInteriorSliderImageCommand($request));

        return [
            'message' => 'Порядок изображений сохранён успешно'
        ];
    }
}
