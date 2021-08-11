<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use Domain\Furniture\Queries\GetFurnitureByIdQuery;
use Domain\FurnitureImage\Queries\GetFurnitureImageByIdQuery;
use Domain\FurnitureImage\Commands\CreateFurnitureImageCommand;
use Domain\FurnitureImage\Commands\DeleteFurnitureImageCommand;
use Domain\FurnitureImage\Commands\UpdatePositionsFurnitureImageCommand;
use Domain\FurnitureImage\Commands\UpdateFurnitureImageCommand;
use App\Http\Controllers\Controller;
use App\Services\UploadImagesService;
use Domain\FurnitureImage\Requests\CreateFurnitureImageRequest;
use Domain\FurnitureImage\Requests\UpdateFurnitureImageRequest;
use Illuminate\Http\Request;

class FurnitureImageController extends Controller
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
        $furniture = $this->dispatch(new GetFurnitureByIdQuery($id));

        $viewFile = request()->get('isMobile') === 'true'
            ? 'admin.furniture._images_box_mob'
            : 'admin.furniture._images_box';

        return [
            'images' => view($viewFile, [
                'furniture' => $furniture
            ])->render()
        ];
    }

    /**
     * @param CreateFurnitureImageRequest $request
     * @param int $furnitureImage
     * @return string[]
     */
    public function store(CreateFurnitureImageRequest $request, int $furnitureImage): array
    {
        $image = $this->imagesService
            ->withThumb()
            ->setWidthThumb(173)
            ->setHeightThumb(157)
            ->upload($request, 'furniture', $furnitureImage);

        $this->dispatch(new CreateFurnitureImageCommand($image));

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
        $image = $this->dispatch(new GetFurnitureImageByIdQuery($id));

        return view('admin.furniture._image_popup', [
            'image' => $image
        ])->render();
    }

    /**
     * @param int $id
     * @param UpdateFurnitureImageRequest $request
     * @return array
     */
    public function update(int $id, UpdateFurnitureImageRequest $request): array
    {
        $this->dispatch(new UpdateFurnitureImageCommand($id, $request));

        $image = $this->dispatch(new GetFurnitureImageByIdQuery($id));
        $furniture = $this->dispatch(new GetFurnitureByIdQuery($image->furniture_id));

        return [
            'images' => view('admin.furniture._images_box', [
                'furniture' => $furniture
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
        $this->dispatch(new DeleteFurnitureImageCommand($id));

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
        $this->dispatch(new UpdatePositionsFurnitureImageCommand($request));

        return [
            'message' => 'Порядок изображений сохранён успешно'
        ];
    }
}
