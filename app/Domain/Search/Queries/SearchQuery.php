<?php

declare(strict_types=1);

namespace Domain\Search\Queries;

use App\Domain\Search\Dto\SearchResultDto;
use App\Http\Requests\Forms\SearchRequest;
use App\Models\Door;
use App\Models\Furniture;
use App\Models\Interior;
use Illuminate\Support\Facades\DB;

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

        if ($this->searchRequest->has('doorAttributes')) {
            $query = DB::table('door_has_attributes')
                ->select('door_id')
                ->whereIn('value', $this->searchRequest->get('doorAttributes'))
                ->groupBy('door_id')
                ->havingRaw('COUNT(`door_id`) = ' . count($this->searchRequest->get('doorAttributes')));

            $searchResult->doors = Door::where('name', 'like', $keyword)
                ->whereIn('id', $query->get()->pluck('door_id')->toArray())
                ->get();
        } else {
            $searchResult->doors = Door::where('name', 'like', $keyword)->get();
        }

        if ($this->searchRequest->has('furnitureAttributes')) {
            $query = DB::table('furniture_has_attributes')
                ->select('furniture_id')
                ->whereIn('value', $this->searchRequest->get('furnitureAttributes'))
                ->groupBy('furniture_id')
                ->havingRaw('COUNT(`furniture_id`) = ' . count($this->searchRequest->get('furnitureAttributes')));

            $searchResult->doors = Furniture::where('name', 'like', $keyword)
                ->whereIn('id', $query->get()->pluck('furniture_id')->toArray())
                ->get();
        } else {
            $searchResult->furniture = Furniture::where('name', 'like', $keyword)->get();
        }

        $searchResult->portfolios = Interior::where('name', 'like', $keyword)->get();

        return $searchResult;
    }
}
