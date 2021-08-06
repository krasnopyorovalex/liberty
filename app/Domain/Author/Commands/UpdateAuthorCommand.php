<?php

declare(strict_types=1);

namespace Domain\Author\Commands;

use Domain\Image\Commands\DeleteImageCommand;
use Domain\Image\Commands\UploadImageCommand;
use Domain\Author\Queries\GetAuthorByIdQuery;
use App\Events\RedirectDetected;
use App\Http\Requests\Request;
use App\Models\Author;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class UpdateAuthorCommand
 * @package Domain\Author\Commands
 */
class UpdateAuthorCommand
{

    use DispatchesJobs;

    private Request $request;
    private int $id;

    /**
     * UpdateAuthorCommand constructor.
     * @param int $id
     * @param Request $request
     */
    public function __construct(int $id, Request $request)
    {
        $this->id = $id;
        $this->request = $request;
    }

    /**
     * @return bool
     */
    public function handle(): bool
    {
        $Author = $this->dispatch(new GetAuthorByIdQuery($this->id));
        $urlNew = $this->request->post('alias');

        if ($Author->getOriginal('alias') != $urlNew) {
            event(new RedirectDetected($Author->getOriginal('alias'), $urlNew));
        }

        if ($this->request->has('image')) {
            if ($Author->image) {
                $this->dispatch(new DeleteImageCommand($Author->image));
            }
            $this->dispatch(new UploadImageCommand($this->request, $Author->id, Author::class));
        }

        return $Author->update($this->request->all());
    }

}
