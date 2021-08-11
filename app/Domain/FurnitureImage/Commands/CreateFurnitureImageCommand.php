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
        $furnitureImage = new FurnitureImage();
        $furnitureImage->basename = $this->uploadImage->getImageHashName();
        $furnitureImage->ext = $this->uploadImage->getExt();
        $furnitureImage->furniture_id = $this->uploadImage->getEntityId();
        $furnitureImage->is_mobile = $this->uploadImage->getIsMobile();

        return $furnitureImage->save();
    }
}
