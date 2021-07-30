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
        $salesLeader = new Collection();
        $salesLeader->fill($this->request->validated());

        if ($this->request->has('image')) {
            $path = $this->request->file('image')->store(Collection::STORE_PATH);
            $salesLeader->image = Storage::url($path);
        }

        if ($this->request->has('image_mob')) {
            $path = $this->request->file('image_mob')->store(Collection::STORE_PATH);
            $salesLeader->image_mob = Storage::url($path);
        }

        return $salesLeader->save();
    }
}
