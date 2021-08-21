<?php

declare(strict_types=1);

namespace App\Http\ViewComposers;

use Domain\HowWeWork\Queries\GetAllHowWeWorksQuery;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Bus\DispatchesJobs;

class HowWeWorkComposer
{
    use DispatchesJobs;

    /**
     * @param View $view
     */
    public function compose(View $view)
    {
        /** @var Collection $collection */
        $howWeWorks = $this->dispatch(new GetAllHowWeWorksQuery());

        $view->with('howWeWorks', $howWeWorks);
    }
}
