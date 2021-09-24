<?php

declare(strict_types=1);

namespace Domain\Contact\Queries;

use App\Models\Contact;

/**
 * Class GetContactByIdQuery
 * @package Domain\Contact\Queries
 */
class GetContactByIdQuery
{
    /**
     * @var int
     */
    private int $id;

    /**
     * GetContactByIdQuery constructor.
     * @param int $id
     */
    public function __construct(int $id)
    {
        $this->id = $id;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        return Contact::findOrFail($this->id);
    }
}
