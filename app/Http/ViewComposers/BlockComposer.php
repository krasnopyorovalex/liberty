<?php

declare(strict_types=1);

namespace App\Http\ViewComposers;

use Domain\Block\Queries\GetAllBlocksQuery;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Bus\DispatchesJobs;

class BlockComposer
{
    use DispatchesJobs;

    private static $blocks;

    /**
     * @param View $view
     */
    public function compose(View $view)
    {
        if (! self::$blocks) {
            /** @var Collection $collection */
            self::$blocks = $this->dispatch(new GetAllBlocksQuery());
        }

        $reindexed = self::$blocks->mapWithKeys(function ($item) {
            return [$item->sys_name => $item->text];
        });

        $view->with('blocks', $reindexed);
    }
}
