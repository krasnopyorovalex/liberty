<?php

declare(strict_types=1);

namespace Domain\DoorImage\Commands;

use App\Models\DoorImage;
use App\Services\UploadImagesService;

/**
 * Class CreateDoorImageCommand
 * @package Domain\DoorImage\Commands
 */
class CreateDoorImageCommand
{

    private UploadImagesService $uploadImage;

    /**
     * CreateDoorImageCommand constructor.
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
        $doorImage = new DoorImage();
        $doorImage->basename = $this->uploadImage->getImageHashName();
        $doorImage->ext = $this->uploadImage->getExt();
        $doorImage->door_id = $this->uploadImage->getEntityId();

        $path = sprintf('storage/doors/%d/%s.%s', $doorImage->door_id, $doorImage->basename, $doorImage->ext);

        $this->uploadImage->createDesktopImage($path, DoorImage::WIDTH, DoorImage::HEIGHT);
        $this->uploadImage->createMobileImage($path, DoorImage::WIDTH_MOBILE, DoorImage::HEIGHT_MOBILE);

        return $doorImage->save();
    }
}
