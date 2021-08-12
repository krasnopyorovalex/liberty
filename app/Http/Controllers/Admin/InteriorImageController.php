<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use Domain\Interior\Queries\GetInteriorByIdQuery;
use Domain\InteriorImage\Queries\GetInteriorImageByIdQuery;
use Domain\InteriorImage\Commands\CreateInteriorImageCommand;
use Domain\InteriorImage\Commands\DeleteInteriorImageCommand;
use Domain\InteriorImage\Commands\UpdatePositionsInteriorImageCommand;
use Domain\InteriorImage\Commands\UpdateInteriorImageCommand;
use App\Http\Controllers\Controller;
use App\Services\UploadImagesService;
use Domain\InteriorImage\Requests\CreateInteriorImageRequest;
use Domain\InteriorImage\Requests\UpdateInteriorImageRequest;
use Illuminate\Http\Request;

class InteriorImageController extends Controller
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
        $interior = $this->dispatch(new GetInteriorByIdQuery($id));

        $viewFile = request()->get('isMobile') === 'true'
            ? 'admin.interiors._images_box_mob'
            : 'admin.interiors._images_box';

        return [
            'images' => view($viewFile, [
                'interior' => $interior
            ])->render()
        ];
    }

    /**
     * @param CreateInteriorImageRequest $request
     * @param int $interiorImage
     * @return string[]
     */
    public function store(CreateInteriorImageRequest $request, int $interiorImage): array
    {
        $image = $this->imagesService
            ->withThumb()
            ->setWidthThumb(173)
            ->setHeightThumb(157)
            ->upload($request, 'interiors', $interiorImage);

        $this->dispatch(new CreateInteriorImageCommand($image));

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
        $image = $this->dispatch(new GetInteriorImageByIdQuery($id));

        return view('admin.interiors._image_popup', [
            'image' => $image
        ])->render();
    }

    /**
     * @param int $id
     * @param UpdateInteriorImageRequest $request
     * @return array
     */
    public function update(int $id, UpdateInteriorImageRequest $request): array
    {
        $this->dispatch(new UpdateInteriorImageCommand($id, $request));

        $image = $this->dispatch(new GetInteriorImageByIdQuery($id));
        $interior = $this->dispatch(new GetInteriorByIdQuery($image->interior_id));

        return [
            'images' => view('admin.interiors._images_box', [
                'interior' => $interior
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
        $this->dispatch(new DeleteInteriorImageCommand($id));

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
        $this->dispatch(new UpdatePositionsInteriorImageCommand($request));

        return [
            'message' => 'Порядок изображений сохранён успешно'
        ];
    }
}
