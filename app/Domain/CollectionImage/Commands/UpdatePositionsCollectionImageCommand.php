<?php

declare(strict_types=1);

namespace Domain\CollectionImage\Commands;

use Domain\CollectionImage\Queries\GetCollectionImageByIdQuery;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;

/**
 * Class UpdatePositionsCollectionImageCommand
 * @package Domain\CollectionImage\Commands
 */
class UpdatePositionsCollectionImageCommand
{
    use DispatchesJobs;

    private Request $request;

    /**
     * UpdatePositionsCollectionImageCommand constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function handle(): void
    {
        $data = $this->request->post()['data'];

        if (is_array($data)) {
            foreach ($data as $position => $imageId) {
                $image = $this->dispatch(new GetCollectionImageByIdQuery((int) $imageId));
                $image->pos = $position;
                $image->update();
            }
        }
    }
}
