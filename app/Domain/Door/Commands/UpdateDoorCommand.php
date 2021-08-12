<?php

declare(strict_types=1);

namespace Domain\Door\Commands;

use Domain\Door\Queries\GetDoorByIdQuery;
use App\Events\RedirectDetected;
use App\Http\Requests\Request;
use App\Models\Door;
use Closure;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Facades\Storage;

/**
 * Class UpdateDoorCommand
 * @package Domain\Door\Commands
 */
class UpdateDoorCommand
{
    use DispatchesJobs;

    private Request $request;
    private int $id;
    private Closure $deleter;

    /**
     * UpdateDoorCommand constructor.
     * @param int $id
     * @param Request $request
     */
    public function __construct(int $id, Request $request)
    {
        $this->id = $id;
        $this->request = $request;

        $this->deleter = static fn (string $path) => Storage::delete($path);
    }

    /**
     * @return bool
     */
    public function handle(): bool
    {
        /** @var Door $Door */
        $Door = $this->dispatch(new GetDoorByIdQuery($this->id));
        $urlNew = $this->request->post('alias');

        if ($Door->getOriginal('alias') != $urlNew) {
            event(new RedirectDetected($Door->getOriginal('alias'), $urlNew));
        }

        if ($this->request->has('image')) {
            if ($Door->image) {
                ($this->deleter)(str_replace('/storage/', '/public/', $Door->image));
            }

            $path = $this->request->file('image')->store(Door::STORE_PATH);
            $Door->image = Storage::url($path);
        }

        if ($this->request->has('image_mob')) {
            if ($Door->image_mob) {
                ($this->deleter)(str_replace('/storage/', '/public/', $Door->image_mob));
            }

            $path = $this->request->file('image_mob')->store(Door::STORE_PATH);
            $Door->image_mob = Storage::url($path);
        }

        if ($this->request->hasFile('file')) {
            if ($Door->file) {
                ($this->deleter)(str_replace('/storage/', '/public/', $Door->file));
            }

            $path = $this->request->file('file')->store(Door::STORE_PATH);
            $Door->file = Storage::url($path);
        }

        if ($this->request->has('DoorAttributes')) {
            $Door->DoorAttributes()->detach();
            $Door->attachDoorAttributes($this->request->post('DoorAttributes'));
        }

        return $Door->update($this->request->validated());
    }
}
