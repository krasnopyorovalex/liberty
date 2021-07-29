<?php

declare(strict_types=1);

namespace App\Domain\SalesLeaders\Queries;

use App\Models\SalesLeaders;

/**
 * Class GetSalesLeadersByAliasQuery
 * @package App\Domain\SalesLeaders\Queries
 */
class GetSalesLeaderByAliasQuery
{
    /**
     * @var string
     */
    private $alias;

    /**
     * GetSalesLeadersByAliasQuery constructor.
     * @param string $alias
     */
    public function __construct(string $alias)
    {
        $this->alias = $alias;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        return SalesLeaders::where('alias', $this->alias)->firstOrFail();
    }
}
