<?php

declare(strict_types=1);

namespace Domain\Autocomplete\Queries;

use App\Http\Requests\Forms\AutocompleteRequest;
use App\Models\Door;
use App\Models\Furniture;
use App\Models\Interior;

class AutocompleteQuery
{
    private AutocompleteRequest $request;

    public function __construct(AutocompleteRequest $request)
    {
        $this->request = $request;
    }

    public function handle(): array
    {
        if (!$this->request->has('value')) {
            return [];
        }

        $keyword = sprintf('%%%s%%', $this->request->get('value'));

        $furniture = Furniture::select('name')->where('name', 'like', $keyword)->get();
        $portfolios = Interior::select('name')->where('name', 'like', $keyword)->get();
        $doors = Door::select('name')->where('name', 'like', $keyword)->get();

        return array_merge_recursive(
            $furniture->pluck('name')->toArray(),
            $portfolios->pluck('name')->toArray(),
            $doors->pluck('name')->toArray()
        );
    }
}
