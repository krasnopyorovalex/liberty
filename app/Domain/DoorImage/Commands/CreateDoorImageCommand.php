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
        $DoorImage = new DoorImage();
        $DoorImage->basename = $this->uploadImage->getImageHashName();
        $DoorImage->ext = $this->uploadImage->getExt();
        $DoorImage->Door_id = $this->uploadImage->getEntityId();
        $DoorImage->is_mobile = $this->uploadImage->getIsMobile();

        return $DoorImage->save();
    }
}
