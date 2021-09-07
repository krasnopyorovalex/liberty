<?php

declare(strict_types=1);

namespace Domain\Search\Queries;

use App\Domain\Search\Dto\SearchResultDto;
use App\Http\Requests\Forms\SearchRequest;
use App\Models\Door;
use App\Models\Furniture;
use App\Models\Interior;

class SearchQuery
{
    private SearchRequest $searchRequest;

    public function __construct(SearchRequest $searchRequest)
    {
        $this->searchRequest = $searchRequest;
    }

    public function handle(): SearchResultDto
    {
        $searchResult = new SearchResultDto();

        if (!$this->searchRequest->has('keyword')) {
            return $searchResult;
        }

        $keyword = sprintf('%%%s%%', $this->searchRequest->get('keyword'));

        $searchResult->furniture = Furniture::where('name', 'like', $keyword)->get();
        $searchResult->portfolios = Interior::where('name', 'like', $keyword)->get();
        $searchResult->doors = Door::where('name', 'like', $keyword)->get();

        return $searchResult;
    }
}
