<?php

declare(strict_types=1);

namespace Domain\AboutBlock\Commands;

use Domain\AboutBlock\Queries\GetAboutBlockByIdQuery;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Facades\Storage;

/**
 * Class DeleteAboutBlockCommand
 * @package Domain\AboutBlock\Commands
 */
class DeleteAboutBlockCommand
{
    use DispatchesJobs;

    /**
     * @var int
     */
    private int $id;

    /**
     * DeleteAboutBlockCommand constructor.
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
        $aboutBlock = $this->dispatch(new GetAboutBlockByIdQuery($this->id));

        if ($aboutBlock->image) {
            Storage::delete(str_replace('/storage/', '/public/', $aboutBlock->image));
        }

        if ($aboutBlock->image_mob) {
            Storage::delete(str_replace('/storage/', '/public/', $aboutBlock->image_mob));
        }

        return $aboutBlock->delete();
    }
}
