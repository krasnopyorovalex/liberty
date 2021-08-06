<?php

declare(strict_types=1);

namespace Domain\ForClient\Commands;

use App\Models\ForClient;
use App\Http\Requests\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class CreateForClientCommand
 * @package Domain\ForClient\Commands
 */
class CreateForClientCommand
{
    use DispatchesJobs;

    private Request $request;

    /**
     * CreateForClientCommand constructor.
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
        return (new ForClient())
            ->fill($this->request->validated())
            ->save();
    }
}
