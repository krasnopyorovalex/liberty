<?php

declare(strict_types=1);

namespace Domain\FurnitureInteriorSliderImage\Commands;

use App\Models\FurnitureInteriorSliderImage;
use App\Services\UploadImagesService;

/**
 * Class CreateFurnitureInteriorSliderImageCommand
 * @package Domain\FurnitureInteriorSliderImage\Commands
 */
class CreateFurnitureInteriorSliderImageCommand
{
    private UploadImagesService $uploadImage;

    /**
     * CreateFurnitureInteriorSliderImageCommand constructor.
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
        $FurnitureInteriorSliderImage = new FurnitureInteriorSliderImage();
        $FurnitureInteriorSliderImage->basename = $this->uploadImage->getImageHashName();
        $FurnitureInteriorSliderImage->ext = $this->uploadImage->getExt();
        $FurnitureInteriorSliderImage->furniture_interior_slider_id = $this->uploadImage->getEntityId();
        $FurnitureInteriorSliderImage->is_mobile = $this->uploadImage->getIsMobile();

        return $FurnitureInteriorSliderImage->save();
    }

}
