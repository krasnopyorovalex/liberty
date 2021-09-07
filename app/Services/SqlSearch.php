<?php

declare(strict_types=1);

namespace App\Services;

use App\Contracts\Search;
use App\Domain\Search\Dto\SearchResultDto;
use App\Http\Requests\Forms\SearchRequest;
use Domain\Search\Queries\SearchQuery;
use Illuminate\Foundation\Bus\DispatchesJobs;

final class SqlSearch implements Search
{
    use DispatchesJobs;

    public function search(SearchRequest $request): SearchResultDto
    {
        return $this->dispatch(new SearchQuery($request));
    }
}
