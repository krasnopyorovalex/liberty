<?php

declare(strict_types=1);

namespace Domain\Door\Queries;

use App\Models\Door;

/**
 * Class GetDoorByAliasQuery
 * @package Domain\Door\Queries
 */
class GetDoorByAliasQuery
{
    /**
     * @var string
     */
    private string $alias;

    /**
     * GetDoorByAliasQuery constructor.
     * @param string $alias
     */
    public function __construct(string $alias)
    {
        $this->alias = $alias;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        return Door::where('alias', $this->alias)
            ->with(['slider', 'imagesForMobile', 'images', 'doorAttributes', 'modifications', 'doorInteriorSlider'])
            ->firstOrFail();
    }
}
