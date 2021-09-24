<?php

declare(strict_types=1);

namespace Domain\Block\Queries;

use App\Models\Block;

/**
 * Class GetAllBlocksQuery
 * @package Domain\Block\Queries
 */
class GetAllBlocksQuery
{
    /**
     * Execute the job.
     */
    public function handle()
    {
        return Block::all();
    }
}
