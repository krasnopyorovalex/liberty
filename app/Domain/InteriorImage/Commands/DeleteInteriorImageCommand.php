<?php

declare(strict_types=1);

namespace Domain\InteriorImage\Commands;

use Domain\InteriorImage\Queries\GetInteriorImageByIdQuery;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Storage;

/**
 * Class DeleteInteriorImageCommand
 * @package Domain\InteriorImage\Commands
 */
class DeleteInteriorImageCommand
{
    use DispatchesJobs;

    private int $id;

    /**
     * DeleteInteriorImageCommand constructor.
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
        $image = $this->dispatch(new GetInteriorImageByIdQuery($this->id));

        Storage::delete([
            'public/interiors/' . $image->interior_id . '/' . $image->basename . '.' . $image->ext,
            'public/interiors/' . $image->interior_id . '/' . $image->basename . '_thumb.' . $image->ext
        ]);

        return $image->delete();
    }

}
