<?php

declare(strict_types=1);

namespace Domain\AboutBlock\Commands;

use Domain\AboutBlock\Queries\GetAboutBlockByIdQuery;
use App\Http\Requests\Request;
use App\Models\AboutBlock;
use Closure;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Facades\Storage;

/**
 * Class UpdateAboutBlockCommand
 * @package Domain\AboutBlock\Commands
 */
class UpdateAboutBlockCommand
{
    use DispatchesJobs;

    private Request $request;
    private int $id;
    private Closure $deleter;

    /**
     * UpdateAboutBlockCommand constructor.
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
        $aboutBlock = $this->dispatch(new GetAboutBlockByIdQuery($this->id));

        if ($this->request->has('image')) {
            if ($aboutBlock->image) {
                ($this->deleter)(str_replace('/storage/', '/public/', $aboutBlock->image));
            }

            $path = $this->request->file('image')->store(AboutBlock::STORE_PATH);
            $aboutBlock->image = Storage::url($path);
        }

        if ($this->request->has('image_mob')) {
            if ($aboutBlock->image_mob) {
                ($this->deleter)(str_replace('/storage/', '/public/', $aboutBlock->image_mob));
            }

            $path = $this->request->file('image_mob')->store(AboutBlock::STORE_PATH);
            $aboutBlock->image_mob = Storage::url($path);
        }

        return $aboutBlock->update($this->request->validated());
    }
}
