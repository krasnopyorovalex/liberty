<?php

declare(strict_types=1);

namespace Domain\HowWeWork\Queries;

use App\Models\HowWeWork;

/**
 * Class GetAllHowWeWorksQuery
 * @package Domain\HowWeWork\Queries
 */
class GetAllHowWeWorksQuery
{
    /**
     * @var bool
     */
    private bool $isPublished;

    /**
     * GetAllHowWeWorksQuery constructor.
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
            return HowWeWork::publish()->get();
        }

        return HowWeWork::all();
    }
}
