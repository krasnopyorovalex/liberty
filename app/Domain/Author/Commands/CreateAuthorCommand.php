<?php

declare(strict_types=1);

namespace Domain\Author\Commands;

use Domain\Image\Commands\UploadImageCommand;
use App\Http\Requests\Request;
use App\Models\Author;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class CreateAuthorCommand
 * @package Domain\Author\Commands
 */
class CreateAuthorCommand
{
    use DispatchesJobs;

    private Request $request;

    /**
     * CreateAuthorCommand constructor.
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
        $author = new Author();
        $author->fill($this->request->validated());
        $author->save();

        if ($this->request->has('image')) {
            return $this->dispatch(new UploadImageCommand($this->request, $author->id, Author::class));
        }

        return true;
    }

}
