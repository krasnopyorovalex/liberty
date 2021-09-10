<?php

declare(strict_types=1);

namespace App\Http\ViewComposers;

use Domain\Door\Queries\GetAllDoorsQuery;
use Domain\Slider\Queries\GetSliderByIdQuery;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Bus\DispatchesJobs;

class SalesLeadersComposer
{
    use DispatchesJobs;

    /**
     * @param View $view
     */
    public function compose(View $view)
    {
        /** @var Collection $salesLeaders */
        $salesLeaders = $this->dispatch(new GetSliderByIdQuery(3));

        dd($salesLeaders->images->pluck(4));

        $view->with('salesLeaders', $salesLeaders);
    }
}
