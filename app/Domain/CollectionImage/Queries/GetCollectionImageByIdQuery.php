<?php

declare(strict_types=1);

namespace Domain\CollectionImage\Queries;

use App\Models\CollectionImage;

/**
 * Class GetCollectionImageByIdQuery
 * @package Domain\CollectionImage\Queries
 */
class GetCollectionImageByIdQuery
{
    /**
     * @var int
     */
    private int $id;

    /**
     * GetCollectionImageByIdQuery constructor.
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
        return CollectionImage::findOrFail($this->id);
    }
}
