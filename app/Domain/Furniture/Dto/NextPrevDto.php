<?php

namespace App\Domain\Furniture\Dto;

use App\Models\Furniture;

class NextPrevDto
{
    public ?Furniture $next = null;
    public ?Furniture $prev = null;
}
