<?php

declare(strict_types=1);

namespace Domain\ForClient\Queries;

use App\Models\ForClient;

/**
 * Class GetAllForClientsQuery
 * @package Domain\ForClient\Queries
 */
class GetAllForClientsQuery
{
    /**
     * Execute the job.
     */
    public function handle()
    {
        return ForClient::all();
    }
}
