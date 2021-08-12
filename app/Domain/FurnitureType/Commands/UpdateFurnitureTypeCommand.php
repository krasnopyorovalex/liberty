<?php

declare(strict_types=1);

namespace Domain\FurnitureType\Commands;

use Domain\FurnitureType\Queries\GetFurnitureTypeByIdQuery;
use App\Http\Requests\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class UpdateFurnitureTypeCommand
 * @package Domain\FurnitureType\Commands
 */
class UpdateFurnitureTypeCommand
{
    use DispatchesJobs;

    private Request $request;
    private int $id;

    /**
     * UpdateFurnitureTypeCommand constructor.
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
        $FurnitureType = $this->dispatch(new GetFurnitureTypeByIdQuery($this->id));

        return $FurnitureType->update($this->request->validated());
    }

}
