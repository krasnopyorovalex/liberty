<?php

declare(strict_types=1);

namespace Domain\Page\Commands;

use Domain\Image\Commands\DeleteImageCommand;
use Domain\Page\Queries\GetPageByIdQuery;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Facades\Storage;

/**
 * Class DeletePageCommand
 * @package Domain\Page\Commands
 */
class DeletePageCommand
{
    use DispatchesJobs;

    /**
     * @var int
     */
    private int $id;

    /**
     * DeletePageCommand constructor.
     * @param int $id
     */
    public function __construct(int $id)
    {
        $this->id = $id;
    }

    /**
     * Execute the job.
     *
     * @return bool
     */
    public function handle(): bool
    {
        $page = $this->dispatch(new GetPageByIdQuery($this->id));

        if ($page->image) {
            $this->dispatch(new DeleteImageCommand($page->image));
        }

        if ($page->image_mob) {
            Storage::delete(str_replace('/storage/', '/public/', $page->image_mob));
        }

        return $page->delete();
    }
}
