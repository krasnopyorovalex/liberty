<?php

declare(strict_types=1);

namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Collection;

trait Images
{
    public function getImages(): Collection
    {
        return is_mobile() ? $this->imagesForMobile()->get() : $this->images()->get();
    }
}
