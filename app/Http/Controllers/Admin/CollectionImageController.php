<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use Domain\Collection\Queries\GetCollectionByIdQuery;
use Domain\CollectionImage\Queries\GetCollectionImageByIdQuery;
use Domain\CollectionImage\Commands\CreateCollectionImageCommand;
use Domain\CollectionImage\Commands\DeleteCollectionImageCommand;
use Domain\CollectionImage\Commands\UpdatePositionsCollectionImageCommand;
use Domain\CollectionImage\Commands\UpdateCollectionImageCommand;
use App\Http\Controllers\Controller;
use App\Services\UploadImagesService;
use Domain\CollectionImage\Requests\CreateCollectionImageRequest;
use Domain\CollectionImage\Requests\UpdateCollectionImageRequest;
use Illuminate\Http\Request;

class CollectionImageController extends Controller
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
        $collection = $this->dispatch(new GetCollectionByIdQuery($id));

        $viewFile = request()->get('isMobile') === 'true'
            ? 'admin.collections._images_box_mob'
            : 'admin.collections._images_box';

        return [
            'images' => view($viewFile, [
                'collection' => $collection
            ])->render()
        ];
    }

    /**
     * @param CreateCollectionImageRequest $request
     * @param int $collectionImage
     * @return string[]
     */
    public function store(CreateCollectionImageRequest $request, int $collectionImage): array
    {
        $image = $this->imagesService
            ->withThumb()
            ->setWidthThumb(173)
            ->setHeightThumb(157)
            ->upload($request, 'collections', $collectionImage);

        $this->dispatch(new CreateCollectionImageCommand($image));

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
        $image = $this->dispatch(new GetCollectionImageByIdQuery($id));

        return view('admin.collections._image_popup', [
            'image' => $image
        ])->render();
    }

    /**
     * @param int $id
     * @param UpdateCollectionImageRequest $request
     * @return array
     */
    public function update(int $id, UpdateCollectionImageRequest $request): array
    {
        $this->dispatch(new UpdateCollectionImageCommand($id, $request));

        $image = $this->dispatch(new GetCollectionImageByIdQuery($id));
        $collection = $this->dispatch(new GetCollectionByIdQuery($image->collection_id));

        return [
            'images' => view('admin.collections._images_box', [
                'collection' => $collection
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
        $this->dispatch(new DeleteCollectionImageCommand($id));

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
        $this->dispatch(new UpdatePositionsCollectionImageCommand($request));

        return [
            'message' => 'Порядок изображений сохранён успешно'
        ];
    }
}
