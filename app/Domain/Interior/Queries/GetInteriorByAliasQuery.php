<?php

declare(strict_types=1);

namespace Domain\Interior\Queries;

use App\Models\Interior;

/**
 * Class GetInteriorByAliasQuery
 * @package Domain\Interior\Queries
 */
class GetInteriorByAliasQuery
{
    /**
     * @var string
     */
    private string $alias;

    /**
     * GetInteriorByAliasQuery constructor.
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
        return Interior::where('alias', $this->alias)->firstOrFail();
    }
}
