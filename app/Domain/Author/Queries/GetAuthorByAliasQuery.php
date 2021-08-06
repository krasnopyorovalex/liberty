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
    private $alias;

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
        return Author::where('alias', $this->alias)->where('is_published', '1')->firstOrFail();
    }
}
