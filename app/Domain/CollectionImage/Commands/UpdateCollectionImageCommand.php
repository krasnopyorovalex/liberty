<?php

declare(strict_types=1);

namespace Domain\CollectionImage\Commands;

use Domain\CollectionImage\Queries\GetCollectionImageByIdQuery;
use App\Http\Requests\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class UpdateCollectionImageCommand
 * @package Domain\CollectionImage\Commands
 */
class UpdateCollectionImageCommand
{
    use DispatchesJobs;

    private Request $request;
    private int $id;

    /**
     * UpdateCollectionImageCommand constructor.
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
        $image = $this->dispatch(new GetCollectionImageByIdQuery($this->id));

        return $image->update($this->request->validated());
    }
}
