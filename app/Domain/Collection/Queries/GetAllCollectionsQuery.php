<?php

declare(strict_types=1);

namespace Domain\Collection\Queries;

use App\Models\Collection;

/**
 * Class GetAllCollectionsQuery
 * @package Domain\Collection\Queries
 */
class GetAllCollectionsQuery
{

    /**
     * @var bool
     */
    private bool $isPublished;

    /**
     * GetAllCollectionsQuery constructor.
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
            return Collection::publish()->get();
        }

        return Collection::all();
    }
}
