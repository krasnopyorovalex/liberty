<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Door;
use Domain\Door\Queries\GetDoorByAliasQuery;
use Domain\Door\Queries\GetDoorsByIdQuery;
use Illuminate\View\View;
use Illuminate\Contracts\View\Factory;

/**
 * Class DoorController
 * @package App\Http\Controllers
 */
class DoorController extends Controller
{
    /**
     * @param string $alias
     * @return Factory|View
     */
    public function __invoke(string $alias)
    {
        /** @var $door Door */
        $door = $this->dispatch(new GetDoorByAliasQuery($alias));
        $relatedDoors = $this->dispatch(new GetDoorsByIdQuery($door));

        return view('door.index', ['door' => $door, 'relatedDoors' => $relatedDoors]);
    }
}
