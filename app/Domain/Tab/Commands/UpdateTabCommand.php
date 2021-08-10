<?php

declare(strict_types=1);

namespace Domain\Tab\Commands;

use Domain\Tab\Queries\GetTabByIdQuery;
use App\Http\Requests\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class UpdateTabCommand
 * @package Domain\Tab\Commands
 */
class UpdateTabCommand
{
    use DispatchesJobs;

    private Request $request;
    private int $id;

    /**
     * UpdateTabCommand constructor.
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
        $tab = $this->dispatch(new GetTabByIdQuery($this->id));

        return $tab->update($this->request->validated());
    }

}
