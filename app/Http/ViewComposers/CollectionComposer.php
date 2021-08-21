<?php

declare(strict_types=1);

namespace App\Http\ViewComposers;

use Domain\Collection\Queries\GetAllCollectionsQuery;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Bus\DispatchesJobs;

class CollectionComposer
{
    use DispatchesJobs;

    /**
     * @param View $view
     */
    public function compose(View $view)
    {
        /** @var Collection $collection */
        $collections = $this->dispatch(new GetAllCollectionsQuery());

        $view->with('collections', $collections);
    }
}
