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
        /** @var Door $door */
        $door = $this->dispatch(new GetDoorByIdQuery($this->id));
        $urlNew = $this->request->post('alias');

        if ($door->getOriginal('alias') != $urlNew) {
            event(new RedirectDetected($door->getOriginal('alias'), $urlNew));
        }

        if ($this->request->has('image')) {
            if ($door->image) {
                ($this->deleter)(str_replace('/storage/', '/public/', $door->image));
            }

            $path = $this->request->file('image')->store(Door::STORE_PATH);
            $door->image = Storage::url($path);
        }

        if ($this->request->has('image_mob')) {
            if ($door->image_mob) {
                ($this->deleter)(str_replace('/storage/', '/public/', $door->image_mob));
            }

            $path = $this->request->file('image_mob')->store(Door::STORE_PATH);
            $door->image_mob = Storage::url($path);
        }

        if ($this->request->hasFile('file')) {
            if ($door->file) {
                ($this->deleter)(str_replace('/storage/', '/public/', $door->file));
            }

            $path = $this->request->file('file')->store(Door::STORE_PATH);
            $door->file = Storage::url($path);
        }

        if ($this->request->has('doorAttributes')) {
            $door->doorAttributes()->detach();
            $door->attachDoorAttributes($this->request->post('doorAttributes'));
        }

        return $door->update($this->request->validated());
    }
}
