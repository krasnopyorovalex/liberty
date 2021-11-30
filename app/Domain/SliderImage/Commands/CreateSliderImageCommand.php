<?php

declare(strict_types=1);

namespace Domain\SliderImage\Commands;

use App\Models\SliderImage;
use App\Services\UploadImagesService;

/**
 * Class CreateSliderImageCommand
 * @package Domain\SliderImage\Commands
 */
class CreateSliderImageCommand
{
    private UploadImagesService $uploadImage;

    /**
     * CreateSliderImageCommand constructor.
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
        $maxPosition = SliderImage::select('pos')->max('pos');

        $sliderImage = new SliderImage();
        $sliderImage->basename = $this->uploadImage->getImageHashName();
        $sliderImage->ext = $this->uploadImage->getExt();
        $sliderImage->slider_id = $this->uploadImage->getEntityId();
        $sliderImage->is_mobile = $this->uploadImage->getIsMobile();
        $sliderImage->pos = $maxPosition + 1;

        return $sliderImage->save();
    }

}
