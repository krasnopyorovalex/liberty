<?php

declare(strict_types=1);

namespace Domain\HowWeWork\Commands;

use Domain\HowWeWork\Queries\GetHowWeWorkByIdQuery;
use App\Http\Requests\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class UpdateHowWeWorkCommand
 * @package Domain\HowWeWork\Commands
 */
class UpdateHowWeWorkCommand
{
    use DispatchesJobs;

    private Request $request;
    private int $id;

    /**
     * UpdateHowWeWorkCommand constructor.
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
        $howWeWork = $this->dispatch(new GetHowWeWorkByIdQuery($this->id));

        return $howWeWork->update($this->request->validated());
    }
}
