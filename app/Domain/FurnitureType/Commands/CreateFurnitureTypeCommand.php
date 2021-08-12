<?php

declare(strict_types=1);

namespace Domain\FurnitureType\Commands;

use App\Http\Requests\Request;
use App\Models\FurnitureType;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class CreateFurnitureTypeCommand
 * @package Domain\FurnitureType\Commands
 */
class CreateFurnitureTypeCommand
{
    use DispatchesJobs;

    private Request $request;

    /**
     * CreateFurnitureTypeCommand constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @return bool
     */
    public function handle(): bool
    {
        return (new FurnitureType())->fill($this->request->validated())->save();
    }

}
