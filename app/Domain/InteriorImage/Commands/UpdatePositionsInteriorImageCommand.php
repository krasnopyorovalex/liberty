<?php

declare(strict_types=1);

namespace Domain\InteriorImage\Commands;

use Domain\InteriorImage\Queries\GetInteriorImageByIdQuery;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;

/**
 * Class UpdatePositionsInteriorImageCommand
 * @package Domain\InteriorImage\Commands
 */
class UpdatePositionsInteriorImageCommand
{
    use DispatchesJobs;

    private Request $request;

    /**
     * UpdatePositionsInteriorImageCommand constructor.
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
                $image = $this->dispatch(new GetInteriorImageByIdQuery((int) $imageId));
                $image->pos = $position;
                $image->update();
            }
        }
    }
}
