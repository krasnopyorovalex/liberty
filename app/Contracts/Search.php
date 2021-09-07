<?php

declare(strict_types=1);

namespace App\Contracts;

use App\Domain\Search\Dto\SearchResultDto;
use App\Http\Requests\Forms\SearchRequest;

interface Search
{
    public function search(SearchRequest $request): SearchResultDto;
}
