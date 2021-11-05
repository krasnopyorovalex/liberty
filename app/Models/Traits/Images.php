<?php

declare(strict_types=1);

namespace App\Models\Traits;

use App\Services\UploadImagesService;
use Illuminate\Database\Eloquent\Collection;

trait Images
{
    public function getImages(): Collection
    {
        return is_mobile() ? $this->imagesForMobile()->get() : $this->images()->get();
    }

    public function getDesktopImage(): string
    {
        return filename_replacer($this->image, UploadImagesService::DESKTOP_POSTFIX);
    }

    public function getMobileImage(): string
    {
        return filename_replacer($this->image, UploadImagesService::MOBILE_POSTFIX);
    }
}
