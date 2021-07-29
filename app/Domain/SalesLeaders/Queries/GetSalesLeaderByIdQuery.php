<?php

namespace App\Domain\SalesLeaders\Queries;

use App\Models\SalesLeaders;

/**
 * Class GetSalesLeadersByIdQuery
 * @package App\Domain\SalesLeaders\Queries
 */
class GetSalesLeaderByIdQuery
{
    /**
     * @var int
     */
    private $id;

    /**
     * GetSalesLeadersByIdQuery constructor.
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
        return SalesLeaders::findOrFail($this->id);
    }
}
