<?php

declare(strict_types=1);

namespace Domain\Tab\Queries;

use App\Models\Tab;

/**
 * Class GetAllTabsQuery
 * @package Domain\Tab\Queries
 */
class GetAllTabsQuery
{
    /**
     * Execute the job.
     */
    public function handle()
    {
        return Tab::all();
    }
}
