<?php

declare(strict_types=1);

namespace Domain\Collection\Commands;

use Domain\Collection\Queries\GetCollectionByIdQuery;
use App\Events\RedirectDetected;
use App\Http\Requests\Request;
use App\Models\Collection;
use Closure;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Facades\Storage;

/**
 * Class UpdateCollectionCommand
 * @package Domain\Collection\Commands
 */
class UpdateCollectionCommand
{
    use DispatchesJobs;

    private Request $request;
    private int $id;
    private Closure $deleter;

    /**
     * UpdateCollectionCommand constructor.
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
        $collection = $this->dispatch(new GetCollectionByIdQuery($this->id));
        $urlNew = $this->request->post('alias');

        if ($collection->getOriginal('alias') != $urlNew) {
            event(new RedirectDetected($collection->getOriginal('alias'), $urlNew));
        }

        if ($this->request->has('image')) {
            if ($collection->image) {
                ($this->deleter)(str_replace('/storage/', '/public/', $collection->image));
            }

            $path = $this->request->file('image')->store(Collection::STORE_PATH);
            $collection->image = Storage::url($path);
        }

        if ($this->request->has('image_mob')) {
            if ($collection->image_mob) {
                ($this->deleter)(str_replace('/storage/', '/public/', $collection->image_mob));
            }

            $path = $this->request->file('image_mob')->store(Collection::STORE_PATH);
            $collection->image_mob = Storage::url($path);
        }

        return $collection->update($this->request->validated());
    }
}
