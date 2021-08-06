<?php

declare(strict_types=1);

namespace Domain\ForClient\Queries;

use App\Models\ForClient;

/**
 * Class GetForClientByIdQuery
 * @package Domain\ForClient\Queries
 */
class GetForClientByIdQuery
{
    /**
     * @var int
     */
    private int $id;

    /**
     * GetForClientByIdQuery constructor.
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
        return ForClient::findOrFail($this->id);
    }
}
