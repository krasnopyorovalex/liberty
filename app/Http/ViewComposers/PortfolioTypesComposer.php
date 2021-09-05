<?php

declare(strict_types=1);

namespace App\Http\ViewComposers;

use Domain\InteriorType\Queries\GetAllInteriorTypesQuery;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Bus\DispatchesJobs;

class PortfolioTypesComposer
{
    use DispatchesJobs;

    /**
     * @param View $view
     */
    public function compose(View $view)
    {
        /** @var Collection $collection */
        $portfolioTypes = $this->dispatch(new GetAllInteriorTypesQuery());

        $view->with('portfolioTypes', $portfolioTypes);
    }
}
