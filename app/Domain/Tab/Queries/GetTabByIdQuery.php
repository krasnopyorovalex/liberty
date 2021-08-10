<?php

declare(strict_types=1);

namespace Domain\Tab\Queries;

use App\Models\Tab;

/**
 * Class GetTabByIdQuery
 * @package Domain\Tab\Queries
 */
class GetTabByIdQuery
{
    /**
     * @var int
     */
    private int $id;

    /**
     * GetTabByIdQuery constructor.
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
        return Tab::findOrFail($this->id);
    }
}
