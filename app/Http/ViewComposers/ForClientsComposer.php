<?php

declare(strict_types=1);

namespace App\Http\ViewComposers;

use Domain\ForClient\Queries\GetAllForClientsQuery;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Bus\DispatchesJobs;

class ForClientsComposer
{
    use DispatchesJobs;

    /**
     * @param View $view
     */
    public function compose(View $view)
    {
        /** @var Collection $collection */
        $forClients = $this->dispatch(new GetAllForClientsQuery());

        $view->with('forClients', $forClients);
    }
}
