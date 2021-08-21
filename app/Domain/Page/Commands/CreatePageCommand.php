<?php

declare(strict_types=1);

namespace Domain\Page\Commands;

use Domain\Image\Commands\UploadImageCommand;
use App\Http\Requests\Request;
use App\Models\Page;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Facades\Storage;

/**
 * Class CreatePageCommand
 * @package Domain\Page\Commands
 */
class CreatePageCommand
{
    use DispatchesJobs;

    private Request $request;

    /**
     * CreatePageCommand constructor.
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
        $page = new Page();
        $page->fill($this->request->validated());
        $page->save();

        if ($this->request->has('image')) {
            return $this->dispatch(new UploadImageCommand($this->request, $page->id, Page::class));
        }

        if ($this->request->has('image_mob')) {
            $path = $this->request->file('image_mob')->store(Page::STORE_PATH);
            $page->image_mob = Storage::url($path);
        }

        return true;
    }
}
