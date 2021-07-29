<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Domain\SalesLeaders\Queries\GetSalesLeaderByAliasQuery;
use Illuminate\View\View;
use Illuminate\Contracts\View\Factory;

/**
 * Class PageController
 * @package App\Http\Controllers
 */
class SalesLeaderController extends Controller
{
    /**
     * @param string $alias
     * @return Factory|View
     */
    public function show(string $alias)
    {
        $salesLeader = $this->dispatch(new GetSalesLeaderByAliasQuery($alias));
    }
}
