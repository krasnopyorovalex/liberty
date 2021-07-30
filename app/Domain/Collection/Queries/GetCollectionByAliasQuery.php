<?php

declare(strict_types=1);

namespace Domain\Collection\Queries;

use App\Models\Collection;

/**
 * Class GetCollectionByAliasQuery
 * @package Domain\Collection\Queries
 */
class GetCollectionByAliasQuery
{
    /**
     * @var string
     */
    private $alias;

    /**
     * GetCollectionByAliasQuery constructor.
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
        return Collection::where('alias', $this->alias)->firstOrFail();
    }
}
