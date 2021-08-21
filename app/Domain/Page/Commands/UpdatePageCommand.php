<?php

declare(strict_types=1);

namespace Domain\Page\Commands;

use Domain\Image\Commands\DeleteImageCommand;
use Domain\Image\Commands\UploadImageCommand;
use Domain\Page\Queries\GetPageByIdQuery;
use App\Events\RedirectDetected;
use App\Http\Requests\Request;
use App\Models\Page;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Facades\Storage;

/**
 * Class UpdatePageCommand
 * @package Domain\Page\Commands
 */
class UpdatePageCommand
{

    use DispatchesJobs;

    private Request $request;
    private int $id;
    private \Closure $deleter;

    /**
     * UpdatePageCommand constructor.
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
        $page = $this->dispatch(new GetPageByIdQuery($this->id));
        $urlNew = $this->request->post('alias');

        if ($page->getOriginal('alias') != $urlNew) {
            event(new RedirectDetected($page->getOriginal('alias'), $urlNew));
        }

        if ($this->request->has('image')) {
            if ($page->image) {
                $this->dispatch(new DeleteImageCommand($page->image));
            }
            $this->dispatch(new UploadImageCommand($this->request, $page->id, Page::class));
        }

        if ($this->request->has('image_mob')) {
            if ($page->image_mob) {
                ($this->deleter)(str_replace('/storage/', '/public/', $page->image_mob));
            }

            $path = $this->request->file('image_mob')->store(Page::STORE_PATH);
            $page->image_mob = Storage::url($path);
        }

        return $page->update($this->request->validated());
    }

}
