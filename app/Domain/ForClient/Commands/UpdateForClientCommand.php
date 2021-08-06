<?php

declare(strict_types=1);

namespace Domain\ForClient\Commands;

use Domain\ForClient\Queries\GetForClientByIdQuery;
use App\Http\Requests\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class UpdateForClientCommand
 * @package Domain\Page\Commands
 */
class UpdateForClientCommand
{
    use DispatchesJobs;

    private Request $request;
    private int $id;

    /**
     * UpdateForClientCommand constructor.
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
        $forClient = $this->dispatch(new GetForClientByIdQuery($this->id));

        return $forClient->update($this->request->validated());
    }

}
