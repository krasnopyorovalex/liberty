<?php

declare(strict_types=1);

namespace Domain\FurnitureImage\Commands;

use App\Models\FurnitureImage;
use App\Services\UploadImagesService;

/**
 * Class CreateFurnitureImageCommand
 * @package Domain\FurnitureImage\Commands
 */
class CreateFurnitureImageCommand
{

    private UploadImagesService $uploadImage;

    /**
     * CreateFurnitureImageCommand constructor.
     * @param UploadImagesService $uploadImage
     */
    public function __construct(UploadImagesService $uploadImage)
    {
        $this->uploadImage = $uploadImage;
    }

    /**
     * @return bool
     */
    public function handle(): bool
    {
        $FurnitureImage = new FurnitureImage();
        $FurnitureImage->basename = $this->uploadImage->getImageHashName();
        $FurnitureImage->ext = $this->uploadImage->getExt();
        $FurnitureImage->furniture_id = $this->uploadImage->getEntityId();

        return $FurnitureImage->save();
    }
}
