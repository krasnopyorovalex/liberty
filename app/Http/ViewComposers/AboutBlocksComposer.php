<?php

declare(strict_types=1);

namespace App\Http\ViewComposers;

use Domain\AboutBlock\Queries\GetAllAboutBlockQuery;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Bus\DispatchesJobs;

class AboutBlocksComposer
{
    use DispatchesJobs;

    /**
     * @param View $view
     */
    public function compose(View $view)
    {
        /** @var Collection $aboutBlocks */
        $aboutBlocks = $this->dispatch(new GetAllAboutBlockQuery());

        $view->with('aboutBlocks', $aboutBlocks);
    }
}
