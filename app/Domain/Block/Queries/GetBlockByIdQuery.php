<?php

declare(strict_types=1);

namespace Domain\Block\Queries;

use App\Models\Block;

/**
 * Class GetBlockByIdQuery
 * @package Domain\Block\Queries
 */
class GetBlockByIdQuery
{
    /**
     * @var int
     */
    private int $id;

    /**
     * GetBlockByIdQuery constructor.
     * @param int $id
     */
    public function __construct(int $id)
    {
        $this->id = $id;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        return Block::findOrFail($this->id);
    }
}
