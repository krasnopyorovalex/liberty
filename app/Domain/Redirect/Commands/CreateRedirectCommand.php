<?php

declare(strict_types=1);

namespace Domain\Redirect\Commands;

use App\Http\Requests\Request;
use App\Models\Redirect;

/**
 * Class CreateRedirectCommand
 * @package Domain\Redirect\Commands
 */
class CreateRedirectCommand
{
    private Request $request;

    /**
     * CreateRedirectCommand constructor.
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
        return (new Redirect())
            ->fill($this->request->validated())
            ->save();
    }
}
