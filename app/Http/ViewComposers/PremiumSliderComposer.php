<?php

declare(strict_types=1);

namespace App\Http\ViewComposers;

use Domain\Interior\Queries\GetInteriorsForPremiumSliderQuery;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Bus\DispatchesJobs;

class PremiumSliderComposer
{
    use DispatchesJobs;

    /**
     * @param View $view
     */
    public function compose(View $view)
    {
        /** @var Collection $sliderItems */
        $sliderItems = $this->dispatch(new GetInteriorsForPremiumSliderQuery());

        $view->with('sliderItems', $sliderItems);
    }
}
