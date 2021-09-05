<?php

declare(strict_types=1);

namespace App\Http\ViewComposers;

use Domain\Interior\Queries\GetAllInteriorsQuery;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Bus\DispatchesJobs;

class PortfolioComposer
{
    use DispatchesJobs;

    /**
     * @param View $view
     */
    public function compose(View $view)
    {
        /** @var Collection $collection */
        $portfolio = $this->dispatch(new GetAllInteriorsQuery());

        $view->with('portfolio', $portfolio);
    }
}
