<?php

declare(strict_types=1);

namespace Domain\CollectionImage\Commands;

use Domain\CollectionImage\Queries\GetCollectionImageByIdQuery;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Storage;

/**
 * Class DeleteCollectionImageCommand
 * @package Domain\CollectionImage\Commands
 */
class DeleteCollectionImageCommand
{
    use DispatchesJobs;

    private int $id;

    /**
     * DeleteCollectionImageCommand constructor.
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
        $image = $this->dispatch(new GetCollectionImageByIdQuery($this->id));

        Storage::delete([
            'public/interiors/' . $image->interior_id . '/' . $image->basename . '.' . $image->ext,
            'public/interiors/' . $image->interior_id . '/' . $image->basename . '_thumb.' . $image->ext
        ]);

        return $image->delete();
    }

}
