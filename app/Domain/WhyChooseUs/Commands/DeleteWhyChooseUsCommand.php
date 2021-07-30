<?php

declare(strict_types=1);

namespace Domain\WhyChooseUs\Commands;

use Domain\WhyChooseUs\Queries\GetWhyChooseUsByIdQuery;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Facades\Storage;

/**
 * Class DeleteWhyChooseUsCommand
 * @package Domain\WhyChooseUs\Commands
 */
class DeleteWhyChooseUsCommand
{
    use DispatchesJobs;

    /**
     * @var int
     */
    private int $id;

    /**
     * DeleteWhyChooseUsCommand constructor.
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
        $whyChooseUs = $this->dispatch(new GetWhyChooseUsByIdQuery($this->id));

        if ($whyChooseUs->image) {
            Storage::delete(str_replace('/storage/', '/public/', $whyChooseUs->image));
        }

        if ($whyChooseUs->image_mob) {
            Storage::delete(str_replace('/storage/', '/public/', $whyChooseUs->image_mob));
        }

        return $whyChooseUs->delete();
    }
}
