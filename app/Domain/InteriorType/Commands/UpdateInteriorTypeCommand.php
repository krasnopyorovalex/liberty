<?php

declare(strict_types=1);

namespace Domain\InteriorType\Commands;

use Domain\InteriorType\Queries\GetInteriorTypeByIdQuery;
use App\Http\Requests\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class UpdateInteriorTypeCommand
 * @package Domain\InteriorType\Commands
 */
class UpdateInteriorTypeCommand
{
    use DispatchesJobs;

    private Request $request;
    private int $id;

    /**
     * UpdateInteriorTypeCommand constructor.
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
        $InteriorType = $this->dispatch(new GetInteriorTypeByIdQuery($this->id));

        return $InteriorType->update($this->request->validated());
    }

}
