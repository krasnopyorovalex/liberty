<?php

declare(strict_types=1);

namespace Domain\FurnitureInteriorSliderImage\Commands;

use Domain\FurnitureInteriorSliderImage\Queries\GetFurnitureInteriorSliderImageByIdQuery;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class DeleteFurnitureInteriorSliderImageCommand
 * @package Domain\FurnitureInteriorSliderImage\Commands
 */
class DeleteFurnitureInteriorSliderImageCommand
{
    use DispatchesJobs;

    private int $id;

    /**
     * DeleteFurnitureInteriorSliderImageCommand constructor.
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
        $image = $this->dispatch(new GetFurnitureInteriorSliderImageByIdQuery($this->id));

        \Storage::delete([
            'public/slider/' . $image->slider_id . '/' . $image->basename . '.' . $image->ext,
            'public/slider/' . $image->slider_id . '/' . $image->basename . '_thumb.' . $image->ext
        ]);

        return $image->delete();
    }

}
