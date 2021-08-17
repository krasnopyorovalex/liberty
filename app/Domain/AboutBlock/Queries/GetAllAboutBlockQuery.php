<?php

declare(strict_types=1);

namespace Domain\AboutBlock\Queries;

use App\Models\AboutBlock;

/**
 * Class GetAllAboutBlocksQuery
 * @package Domain\AboutBlock\Queries
 */
class GetAllAboutBlockQuery
{
    /**
     * Execute the job.
     */
    public function handle()
    {
        return AboutBlock::all();
    }
}
