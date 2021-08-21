<?php

declare(strict_types=1);

namespace App\Http\ViewComposers;

use Domain\WhyChooseUs\Queries\GetAllWhyChooseUsQuery;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Bus\DispatchesJobs;

class WhyChooseUsComposer
{
    use DispatchesJobs;

    /**
     * @param View $view
     */
    public function compose(View $view)
    {
        $whyChooseUs = $this->dispatch(new GetAllWhyChooseUsQuery());

        $view->with('whyChooseUs', $whyChooseUs);
    }
}
