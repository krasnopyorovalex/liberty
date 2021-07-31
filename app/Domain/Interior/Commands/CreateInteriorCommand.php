<?php

declare(strict_types=1);

namespace Domain\Interior\Commands;

use App\Http\Requests\Request;
use App\Models\Interior;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Facades\Storage;

/**
 * Class CreateInteriorCommand
 * @package Domain\Interior\Commands
 */
class CreateInteriorCommand
{
    use DispatchesJobs;

    private Request $request;

    /**
     * CreateInteriorCommand constructor.
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
        $salesLeader = new Interior();
        $salesLeader->fill($this->request->validated());

        if ($this->request->has('image')) {
            $path = $this->request->file('image')->store(Interior::STORE_PATH);
            $salesLeader->image = Storage::url($path);
        }

        if ($this->request->has('image_mob')) {
            $path = $this->request->file('image_mob')->store(Interior::STORE_PATH);
            $salesLeader->image_mob = Storage::url($path);
        }

        return $salesLeader->save();
    }
}
