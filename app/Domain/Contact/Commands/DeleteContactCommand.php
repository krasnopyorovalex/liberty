<?php

declare(strict_types=1);

namespace Domain\Contact\Commands;

use App\Models\Contact;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class DeleteContactCommand
 * @package Domain\Contact\Commands
 */
class DeleteContactCommand
{
    use DispatchesJobs;

    /**
     * @var int
     */
    private int $id;

    /**
     * DeletePageCommand constructor.
     * @param int $id
     */
    public function __construct(int $id)
    {
        $this->id = $id;
    }

    /**
     * Execute the job.
     *
     * @return bool
     */
    public function handle(): bool
    {
        return Contact::whereId($this->id)->delete();
    }
}
