<?php

declare(strict_types=1);

namespace Domain\InteriorImage\Commands;

use Domain\InteriorImage\Queries\GetInteriorImageByIdQuery;
use App\Http\Requests\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class UpdateInteriorImageCommand
 * @package Domain\InteriorImage\Commands
 */
class UpdateInteriorImageCommand
{
    use DispatchesJobs;

    private Request $request;
    private int $id;

    /**
     * UpdateInteriorImageCommand constructor.
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
        $image = $this->dispatch(new GetInteriorImageByIdQuery($this->id));

        return $image->update($this->request->validated());
    }
}
