<?php

declare(strict_types=1);

namespace Domain\FurnitureAttribute\Commands;

use Domain\FurnitureAttribute\Queries\GetFurnitureAttributeByIdQuery;
use App\Http\Requests\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class UpdateFurnitureAttributeCommand
 * @package Domain\FurnitureAttribute\Commands
 */
class UpdateFurnitureAttributeCommand
{
    use DispatchesJobs;

    private Request $request;
    private int $id;

    /**
     * UpdateFurnitureAttributeCommand constructor.
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
        $FurnitureAttribute = $this->dispatch(new GetFurnitureAttributeByIdQuery($this->id));

        return $FurnitureAttribute->update($this->request->validated());
    }

}
