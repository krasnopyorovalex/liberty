<?php

declare(strict_types=1);

namespace Domain\Interior\Commands;

use Domain\Interior\Queries\GetInteriorByIdQuery;
use App\Events\RedirectDetected;
use App\Http\Requests\Request;
use App\Models\Interior;
use Closure;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Facades\Storage;

/**
 * Class UpdateInteriorCommand
 * @package Domain\Interior\Commands
 */
class UpdateInteriorCommand
{
    use DispatchesJobs;

    private Request $request;
    private int $id;
    private Closure $deleter;

    /**
     * UpdateInteriorCommand constructor.
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
        $interior = $this->dispatch(new GetInteriorByIdQuery($this->id));
        $urlNew = $this->request->post('alias');

        if ($interior->getOriginal('alias') != $urlNew) {
            event(new RedirectDetected($interior->getOriginal('alias'), $urlNew));
        }

        if ($this->request->has('image')) {
            if ($interior->image) {
                ($this->deleter)(str_replace('/storage/', '/public/', $interior->image));
            }

            $path = $this->request->file('image')->store(Interior::STORE_PATH);
            $interior->image = Storage::url($path);
        }

        if ($this->request->has('image_mob')) {
            if ($interior->image_mob) {
                ($this->deleter)(str_replace('/storage/', '/public/', $interior->image_mob));
            }

            $path = $this->request->file('image_mob')->store(Interior::STORE_PATH);
            $interior->image_mob = Storage::url($path);
        }

        return $interior->update($this->request->validated());
    }
}
