<?php

declare(strict_types=1);

namespace Domain\FurnitureImage\Commands;

use Domain\FurnitureImage\Queries\GetFurnitureImageByIdQuery;
use App\Http\Requests\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class UpdateFurnitureImageCommand
 * @package Domain\FurnitureImage\Commands
 */
class UpdateFurnitureImageCommand
{
    use DispatchesJobs;

    private Request $request;
    private int $id;

    /**
     * UpdateFurnitureImageCommand constructor.
     * @param int $id
     * @param Request $request
     */
    public function __construct(int $id, Request $request)
    {
        $this->id = $id;
        $this->request = $request;
    }

    /**
     * @return bool
     */
    public function handle(): bool
    {
        $image = $this->dispatch(new GetFurnitureImageByIdQuery($this->id));

        return $image->update($this->request->validated());
    }
}
