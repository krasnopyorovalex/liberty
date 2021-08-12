<?php

declare(strict_types=1);

namespace Domain\InteriorType\Commands;

use App\Http\Requests\Request;
use App\Models\InteriorType;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class CreateInteriorTypeCommand
 * @package Domain\InteriorType\Commands
 */
class CreateInteriorTypeCommand
{
    use DispatchesJobs;

    private Request $request;

    /**
     * CreateInteriorTypeCommand constructor.
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
        return (new InteriorType())->fill($this->request->validated())->save();
    }

}
