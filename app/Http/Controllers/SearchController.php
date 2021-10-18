<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Contracts\Search;
use App\Http\Requests\Forms\SearchRequest;
use Domain\DoorAttribute\Queries\GetAllDoorAttributesQuery;
use Domain\FurnitureAttribute\Queries\GetAllFurnitureAttributesQuery;

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

        $doorAttributes = $this->dispatch(new GetAllDoorAttributesQuery());
        $furnitureAttributes = $this->dispatch(new GetAllFurnitureAttributesQuery());

        return view('search.index', [
            'searchResult' => $searchResult,
            'doorAttributes' => $doorAttributes,
            'furnitureAttributes' => $furnitureAttributes
        ]);
    }
}
