<?php

declare(strict_types=1);

namespace Domain\Contact\Queries;

use App\Models\Contact;

/**
 * Class GetAllContactsQuery
 * @package Domain\Contact\Queries
 */
class GetAllContactsQuery
{
    /**
     * Execute the job.
     */
    public function handle()
    {
        return Contact::all();
    }
}
