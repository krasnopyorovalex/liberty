<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Domain\Image\Commands\DeleteImageCommand;
use App\Domain\Image\Commands\UpdateImageCommand;
use App\Domain\Image\Queries\GetImageByIdQuery;
use App\Http\Controllers\Controller;
use Domain\Image\Requests\UpdateImageRequest;

/**
 * Class ImageController
 * @package App\Http\Controllers\Admin
 */
class ImageController extends Controller
{
    /**
     * @param int $id
     * @param UpdateImageRequest $request
     * @return string[]
     */
    public function update(int $id, UpdateImageRequest $request): array
    {
        $this->dispatch(new UpdateImageCommand($id, $request));

        return [
            'message' => 'Атрибуты изображения сохранены успешно'
        ];
    }

    /**
     * @param int $id
     * @return array
     */
    public function destroy(int $id): array
    {
        $image = $this->dispatch(new GetImageByIdQuery($id));

        $this->dispatch(new DeleteImageCommand($image));

        return [
            'message' => 'Изображение удалено'
        ];
    }
}
