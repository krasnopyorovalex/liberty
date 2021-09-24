<?php

declare(strict_types=1);

namespace Domain\Contact\Commands;

use App\Http\Requests\Request;
use App\Models\Contact;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class CreateContactCommand
 * @package Domain\Contact\Commands
 */
class CreateContactCommand
{
    use DispatchesJobs;

    private Request $request;

    /**
     * CreateContactCommand constructor.
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
        return (new Contact())->fill($this->request->validated())->save();
    }

}
