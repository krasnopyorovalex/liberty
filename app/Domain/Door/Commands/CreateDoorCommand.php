<?php

declare(strict_types=1);

namespace Domain\Door\Commands;

use App\Http\Requests\Request;
use App\Models\Door;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Facades\Storage;

/**
 * Class CreateDoorCommand
 * @package Domain\Door\Commands
 */
class CreateDoorCommand
{
    use DispatchesJobs;

    private Request $request;

    /**
     * CreateDoorCommand constructor.
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
        $door = new Door();
        $door->fill($this->request->validated());

        if ($this->request->hasFile('image')) {
            $path = $this->request->file('image')->store(Door::STORE_PATH);
            $door->image = Storage::url($path);
        }

        if ($this->request->hasFile('image_mob')) {
            $path = $this->request->file('image_mob')->store(Door::STORE_PATH);
            $door->image_mob = Storage::url($path);
        }

        if ($this->request->hasFile('file')) {
            $path = $this->request->file('file')->store(Door::STORE_PATH);
            $door->file = Storage::url($path);
        }

        $door->save();

        if ($this->request->has('doorAttributes')) {
            $door->attachDoorAttributes($this->request->post('doorAttributes'));
        }

        return true;
    }
}
