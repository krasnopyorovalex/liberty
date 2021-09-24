<?php

declare(strict_types=1);

namespace Domain\Block\Commands;

use App\Http\Requests\Request;
use App\Models\Block;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class CreateBlockCommand
 * @package Domain\Block\Commands
 */
class CreateBlockCommand
{
    use DispatchesJobs;

    private Request $request;

    /**
     * CreateBlockCommand constructor.
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
        return (new Block())->fill($this->request->validated())->save();
    }

}
