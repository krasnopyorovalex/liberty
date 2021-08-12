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
        $interiorImage = new InteriorImage();
        $interiorImage->basename = $this->uploadImage->getImageHashName();
        $interiorImage->ext = $this->uploadImage->getExt();
        $interiorImage->interior_id = $this->uploadImage->getEntityId();
        $interiorImage->is_mobile = $this->uploadImage->getIsMobile();

        return $interiorImage->save();
    }
}
