<?php

declare(strict_types=1);

namespace Domain\Author\Commands;

use Domain\Image\Commands\DeleteImageCommand;
use Domain\Author\Queries\GetAuthorByIdQuery;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class DeleteAuthorCommand
 * @package Domain\Author\Commands
 */
class DeleteAuthorCommand
{

    use DispatchesJobs;

    /**
     * @var int
     */
    private $id;

    /**
     * DeleteAuthorCommand constructor.
     * @param int $id
     */
    public function __construct(int $id)
    {
        $this->id = $id;
    }

    /**
     * Execute the job.
     *
     * @return bool
     */
    public function handle(): bool
    {
        $Author = $this->dispatch(new GetAuthorByIdQuery($this->id));

        if ($Author->image) {
            $this->dispatch(new DeleteImageCommand($Author->image));
        }

        return $Author->delete();
    }

}
