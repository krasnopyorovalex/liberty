<?php

declare(strict_types=1);

namespace App\Domain\Search\Dto;

use Illuminate\Database\Eloquent\Collection;

class SearchResultDto
{
    public ?Collection $furniture = null;
    public ?Collection $doors = null;
    public ?Collection $portfolios = null;
}
