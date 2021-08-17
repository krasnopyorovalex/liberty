<?php

declare(strict_types=1);

namespace Domain\DoorInteriorSliderImage\Commands;

use App\Models\DoorInteriorSliderImage;
use App\Services\UploadImagesService;

/**
 * Class CreateDoorInteriorSliderImageCommand
 * @package Domain\DoorInteriorSliderImage\Commands
 */
class CreateDoorInteriorSliderImageCommand
{
    private UploadImagesService $uploadImage;

    /**
     * CreateDoorInteriorSliderImageCommand constructor.
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
        $doorInteriorSliderImage = new DoorInteriorSliderImage();
        $doorInteriorSliderImage->basename = $this->uploadImage->getImageHashName();
        $doorInteriorSliderImage->ext = $this->uploadImage->getExt();
        $doorInteriorSliderImage->door_interior_slider_id = $this->uploadImage->getEntityId();
        $doorInteriorSliderImage->is_mobile = $this->uploadImage->getIsMobile();

        return $doorInteriorSliderImage->save();
    }

}
