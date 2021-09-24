<?php

declare(strict_types=1);

namespace Domain\Contact\Commands;

use Domain\Contact\Queries\GetContactByIdQuery;
use App\Http\Requests\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class UpdateContactCommand
 * @package Domain\Contact\Commands
 */
class UpdateContactCommand
{
    use DispatchesJobs;

    private Request $request;
    private int $id;

    /**
     * UpdateContactCommand constructor.
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
        $contact = $this->dispatch(new GetContactByIdQuery($this->id));

        return $contact->update($this->request->validated());
    }

}
