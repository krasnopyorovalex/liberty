<?php

declare(strict_types=1);

namespace Domain\Author\Queries;

use App\Models\Author;

class GetAllAuthorsWithCountRelationsQuery
{
    /**
     * Execute the job.
     */
    public function handle()
    {
        return Author::with(['image'])
            ->withCount(['furniture', 'doors', 'interiors'])
            ->orderBy('pos')
            ->get();
    }
}
