<?php

declare(strict_types=1);

namespace Domain\FurnitureImage\Commands;

use Domain\FurnitureImage\Queries\GetFurnitureImageByIdQuery;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Storage;

/**
 * Class DeleteFurnitureImageCommand
 * @package Domain\FurnitureImage\Commands
 */
class DeleteFurnitureImageCommand
{
    use DispatchesJobs;

    private int $id;

    /**
     * DeleteFurnitureImageCommand constructor.
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
        $image = $this->dispatch(new GetFurnitureImageByIdQuery($this->id));

        Storage::delete([
            'public/interiors/' . $image->interior_id . '/' . $image->basename . '.' . $image->ext,
            'public/interiors/' . $image->interior_id . '/' . $image->basename . '_thumb.' . $image->ext
        ]);

        return $image->delete();
    }

}
