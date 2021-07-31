<?php

declare(strict_types=1);

namespace Domain\Interior\Queries;

use App\Models\Interior;

/**
 * Class GetAllInteriorsQuery
 * @package Domain\Interior\Queries
 */
class GetAllInteriorsQuery
{

    /**
     * @var bool
     */
    private bool $isPublished;

    /**
     * GetAllInteriorsQuery constructor.
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
            return Interior::publish()->get();
        }

        return Interior::all();
    }
}
