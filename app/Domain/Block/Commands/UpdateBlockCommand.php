<?php

declare(strict_types=1);

namespace Domain\Block\Commands;

use Domain\Block\Queries\GetBlockByIdQuery;
use App\Http\Requests\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class UpdateBlockCommand
 * @package Domain\Block\Commands
 */
class UpdateBlockCommand
{
    use DispatchesJobs;

    private Request $request;
    private int $id;

    /**
     * UpdateBlockCommand constructor.
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
        $Block = $this->dispatch(new GetBlockByIdQuery($this->id));

        return $Block->update($this->request->validated());
    }

}
