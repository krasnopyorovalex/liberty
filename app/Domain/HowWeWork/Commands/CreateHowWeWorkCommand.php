<?php

declare(strict_types=1);

namespace Domain\HowWeWork\Commands;

use App\Http\Requests\Request;
use App\Models\HowWeWork;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class CreateHowWeWorkCommand
 * @package Domain\HowWeWork\Commands
 */
class CreateHowWeWorkCommand
{
    use DispatchesJobs;

    private Request $request;

    /**
     * CreateHowWeWorkCommand constructor.
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
        $howWeWork = new HowWeWork();
        $howWeWork->fill($this->request->validated());

        return $howWeWork->save();
    }
}
