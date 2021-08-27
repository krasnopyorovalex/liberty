<?php

declare(strict_types=1);

namespace App\Http\ViewComposers;

use Domain\Door\Queries\GetAllDoorsQuery;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Bus\DispatchesJobs;

class DoorsComposer
{
    use DispatchesJobs;

    /**
     * @param View $view
     */
    public function compose(View $view)
    {
        /** @var Collection $doors */
        $doors = $this->dispatch(new GetAllDoorsQuery());

        $view->with('doors', $doors);
    }
}
