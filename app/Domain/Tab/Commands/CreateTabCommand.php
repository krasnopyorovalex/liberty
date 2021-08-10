<?php

declare(strict_types=1);

namespace Domain\Tab\Commands;

use App\Http\Requests\Request;
use App\Models\Tab;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class CreateTabCommand
 * @package Domain\Tab\Commands
 */
class CreateTabCommand
{
    use DispatchesJobs;

    private Request $request;

    /**
     * CreateTabCommand constructor.
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
        return (new Tab())->fill($this->request->validated())->save();
    }

}
