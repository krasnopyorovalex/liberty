<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Furniture;
use Domain\Furniture\Queries\GetFurnitureByAliasQuery;
use Illuminate\View\View;
use Illuminate\Contracts\View\Factory;

class FurnitureController extends Controller
{
    /**
     * @param string $alias
     * @return Factory|View
     */
    public function __invoke(string $alias)
    {
        /** @var $furniture Furniture */
        $furniture = $this->dispatch(new GetFurnitureByAliasQuery($alias));

        return view('furniture.index', ['furniture' => $furniture]);
    }
}
