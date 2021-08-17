<?php

declare(strict_types=1);

namespace Domain\AboutBlock\Commands;

use App\Http\Requests\Request;
use App\Models\AboutBlock;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Facades\Storage;

/**
 * Class CreateAboutBlockCommand
 * @package Domain\AboutBlock\Commands
 */
class CreateAboutBlockCommand
{
    use DispatchesJobs;

    private Request $request;

    /**
     * CreateAboutBlockCommand constructor.
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
        $aboutBlock = new AboutBlock();
        $aboutBlock->fill($this->request->validated());

        if ($this->request->has('image')) {
            $path = $this->request->file('image')->store(AboutBlock::STORE_PATH);
            $aboutBlock->image = Storage::url($path);
        }

        if ($this->request->has('image_mob')) {
            $path = $this->request->file('image_mob')->store(AboutBlock::STORE_PATH);
            $aboutBlock->image_mob = Storage::url($path);
        }

        return $aboutBlock->save();
    }
}
