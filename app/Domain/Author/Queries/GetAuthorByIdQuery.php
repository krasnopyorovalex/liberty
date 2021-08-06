<?php

declare(strict_types=1);

namespace Domain\Author\Queries;

use App\Models\Author;

/**
 * Class GetAuthorByIdQuery
 * @package Domain\Author\Queries
 */
class GetAuthorByIdQuery
{
    /**
     * @var int
     */
    private $id;

    /**
     * GetAuthorByIdQuery constructor.
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
        return Author::with(['image'])->findOrFail($this->id);
    }
}
