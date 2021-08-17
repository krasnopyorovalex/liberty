<?php

declare(strict_types=1);

namespace Domain\AboutBlock\Queries;

use App\Models\AboutBlock;

/**
 * Class GetAboutBlockByIdQuery
 * @package Domain\AboutBlock\Queries
 */
class GetAboutBlockByIdQuery
{
    /**
     * @var int
     */
    private int $id;

    /**
     * GetAboutBlockByIdQuery constructor.
     * @param int $id
     */
    public function __construct(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function handle()
    {
        return AboutBlock::findOrFail($this->id);
    }
}
