<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Contracts\Search;
use App\Http\Requests\Forms\SearchRequest;

class SearchController extends Controller
{
    private Search $searchService;

    public function __construct(Search $searchService)
    {
        $this->searchService = $searchService;
    }

    public function __invoke(SearchRequest $request)
    {
        $searchResult = $this->searchService->search($request);

        return view('search.index', [
            'searchResult' => $searchResult
        ]);
    }
}
