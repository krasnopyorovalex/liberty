<?php

namespace Domain\MenuItem\Queries;

use App\Models\MenuItem;

/**
 * Class GetMenuItemsByLinkQuery
 * @package Domain\MenuItem\Queries
 */
class GetMenuItemsByLinkQuery
{
    /**
     * @var string
     */
    private string $link;

    /**
     * GetMenuItemsByLinkQuery constructor.
     * @param string $id
     */
    public function __construct(string $id)
    {
        $this->link = $id;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        return MenuItem::where(['link' => $this->link])->get();
    }
}
