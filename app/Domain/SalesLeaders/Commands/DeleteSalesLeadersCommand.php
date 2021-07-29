<?php

namespace App\Domain\SalesLeaders\Commands;

use App\Domain\Image\Commands\DeleteImageCommand;
use App\Domain\SalesLeaders\Queries\GetSalesLeadersByIdQuery;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class DeleteSalesLeadersCommand
 * @package App\Domain\SalesLeaders\Commands
 */
class DeleteSalesLeadersCommand
{

    use DispatchesJobs;

    /**
     * @var int
     */
    private $id;

    /**
     * DeleteSalesLeadersCommand constructor.
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
        $SalesLeaders = $this->dispatch(new GetSalesLeadersByIdQuery($this->id));

        if($SalesLeaders->image) {
            $this->dispatch(new DeleteImageCommand($SalesLeaders->image));
        }

        return $SalesLeaders->delete();
    }

}
