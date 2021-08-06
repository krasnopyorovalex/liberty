<?php

declare(strict_types=1);

namespace Domain\Page\Queries;

use App\Models\Page;

/**
 * Class GetPageByIdQuery
 * @package Domain\Page\Queries
 */
class GetPageByIdQuery
{
    /**
     * @var int
     */
    private int $id;

    /**
     * GetPageByIdQuery constructor.
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
        return Page::with(['image'])->findOrFail($this->id);
    }
}
