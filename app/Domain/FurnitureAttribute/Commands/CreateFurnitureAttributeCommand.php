<?php

declare(strict_types=1);

namespace Domain\FurnitureAttribute\Commands;

use App\Http\Requests\Request;
use App\Models\FurnitureAttribute;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class CreateFurnitureAttributeCommand
 * @package Domain\FurnitureAttribute\Commands
 */
class CreateFurnitureAttributeCommand
{
    use DispatchesJobs;

    private Request $request;

    /**
     * CreateFurnitureAttributeCommand constructor.
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
        return (new FurnitureAttribute())->fill($this->request->validated())->save();
    }

}
