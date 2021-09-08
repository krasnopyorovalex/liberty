<?php

declare(strict_types=1);

namespace Domain\Author\Queries;

use App\Models\Author;

/**
 * Class GetAuthorByAliasQuery
 * @package Domain\Author\Queries
 */
class GetAuthorByAliasQuery
{
    /**
     * @var string
     */
    private string $alias;

    /**
     * GetAuthorByAliasQuery constructor.
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
        return Author::with(['furniture', 'interiors', 'doors'])
            ->where('alias', $this->alias)
            ->firstOrFail();
    }
}
