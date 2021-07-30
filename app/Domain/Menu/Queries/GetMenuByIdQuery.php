<?php

namespace Domain\Menu\Queries;

use App\Models\Menu;

/**
 * Class GetMenuByIdQuery
 * @package Domain\Menu\Queries
 */
class GetMenuByIdQuery
{
    /**
     * @var int
     */
    private $id;

    /**
     * GetMenuByIdQuery constructor.
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
        return Menu::findOrFail($this->id);
    }
}
