<?php

declare(strict_types=1);

namespace Domain\Author\Queries;

use App\Models\Author;

/**
 * Class GetAllAuthorsQuery
 * @package Domain\Author\Queries
 */
class GetAllAuthorsQuery
{
    /**
     * Execute the job.
     */
    public function handle()
    {
        return Author::orderBy('pos')->get();
    }
}
