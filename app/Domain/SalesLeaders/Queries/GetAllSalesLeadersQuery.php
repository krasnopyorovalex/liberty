<?php

namespace App\Domain\SalesLeaders\Queries;

use App\Models\SalesLeaders;

/**
 * Class GetAllSalesLeaderssQuery
 * @package App\Domain\SalesLeaders\Queries
 */
class GetAllSalesLeadersQuery
{

    /**
     * @var bool
     */
    private $isPublished;

    /**
     * GetAllSalesLeaderssQuery constructor.
     * @param bool $isPublished
     */
    public function __construct(bool $isPublished = false)
    {
        $this->isPublished = $isPublished;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {

        if ($this->isPublished) {
            return SalesLeaders::publish()->get();
        }

        return SalesLeaders::all();
    }
}
