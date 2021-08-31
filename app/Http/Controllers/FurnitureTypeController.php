<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\FurnitureType;
use Domain\FurnitureType\Queries\GetFurnitureTypeByIdQuery;
use Domain\Page\Queries\GetPageByAliasQuery;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class FurnitureTypeController extends Controller
{
    /**
     * @param int $id
     * @return Application|Factory|View
     */
    public function __invoke(int $id)
    {
        /** @var $furnitureType FurnitureType */
        $furnitureType = $this->dispatch(new GetFurnitureTypeByIdQuery($id));

        $page = $this->dispatch(new GetPageByAliasQuery('furniture'));

        return view('furniture-type.index', ['page' => $page, 'furnitureType' => $furnitureType]);
    }
}
