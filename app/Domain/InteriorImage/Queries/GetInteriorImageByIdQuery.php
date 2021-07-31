<?php

declare(strict_types=1);

namespace Domain\InteriorImage\Queries;

use App\Models\InteriorImage;

/**
 * Class GetInteriorImageByIdQuery
 * @package Domain\InteriorImage\Queries
 */
class GetInteriorImageByIdQuery
{
    /**
     * @var int
     */
    private int $id;

    /**
     * GetInteriorImageByIdQuery constructor.
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
        return InteriorImage::findOrFail($this->id);
    }
}
