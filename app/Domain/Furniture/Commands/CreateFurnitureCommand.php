<?php

declare(strict_types=1);

namespace Domain\Furniture\Commands;

use App\Http\Requests\Request;
use App\Models\Furniture;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Facades\Storage;

/**
 * Class CreateFurnitureCommand
 * @package Domain\Furniture\Commands
 */
class CreateFurnitureCommand
{
    use DispatchesJobs;

    private Request $request;

    /**
     * CreateFurnitureCommand constructor.
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
        $furniture = new Furniture();
        $furniture->fill($this->request->validated());

        if ($this->request->hasFile('image')) {
            $path = $this->request->file('image')->store(Furniture::STORE_PATH);
            $furniture->image = Storage::url($path);
        }

        if ($this->request->hasFile('image_mob')) {
            $path = $this->request->file('image_mob')->store(Furniture::STORE_PATH);
            $furniture->image_mob = Storage::url($path);
        }

        if ($this->request->hasFile('file')) {
            $path = $this->request->file('file')->store(Furniture::STORE_PATH);
            $furniture->file = Storage::url($path);
        }

        $furniture->save();

        if ($this->request->has('furnitureAttributes')) {
            $furniture->attachFurnitureAttributes($this->request->post('furnitureAttributes'));
        }

        return true;
    }
}
