<?php

declare(strict_types=1);

namespace Domain\Collection\Commands;

use App\Http\Requests\Request;
use App\Models\Collection;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Facades\Storage;

/**
 * Class CreateCollectionCommand
 * @package Domain\Collection\Commands
 */
class CreateCollectionCommand
{
    use DispatchesJobs;

    private Request $request;

    /**
     * CreateCollectionCommand constructor.
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
        $collection = new Collection();
        $collection->fill($this->request->validated());

        if ($this->request->has('image')) {
            $path = $this->request->file('image')->store(Collection::STORE_PATH);
            $collection->image = Storage::url($path);
        }

        if ($this->request->has('image_mob')) {
            $path = $this->request->file('image_mob')->store(Collection::STORE_PATH);
            $collection->image_mob = Storage::url($path);
        }

        if ($this->request->has('catalog_file')) {
            $path = $this->request->file('catalog_file')->store(Collection::STORE_PATH);
            $collection->catalog_file = Storage::url($path);
        }

        return $collection->save();
    }
}
