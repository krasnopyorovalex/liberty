<?php

declare(strict_types=1);

namespace Domain\Page\Queries;

use App\Models\Page;

/**
 * Class GetPageByAliasQuery
 * @package Domain\Page\Queries
 */
class GetPageByAliasQuery
{
    /**
     * @var string
     */
    private string $alias;

    /**
     * GetPageByAliasQuery constructor.
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
        return Page::with(['slider', 'image'])
            ->where('alias', $this->alias)
            ->where('is_published', '1')
            ->firstOrFail();
    }
}
