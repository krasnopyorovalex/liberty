<?php

declare(strict_types=1);

namespace Domain\InteriorImage\Commands;

use App\Models\InteriorImage;
use App\Services\UploadImagesService;

/**
 * Class CreateInteriorImageCommand
 * @package Domain\InteriorImage\Commands
 */
class CreateInteriorImageCommand
{

    private UploadImagesService $uploadImage;

    /**
     * CreateInteriorImageCommand constructor.
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
        $InteriorImage = new InteriorImage();
        $InteriorImage->basename = $this->uploadImage->getImageHashName();
        $InteriorImage->ext = $this->uploadImage->getExt();
        $InteriorImage->interior_id = $this->uploadImage->getEntityId();

        return $InteriorImage->save();
    }
}
