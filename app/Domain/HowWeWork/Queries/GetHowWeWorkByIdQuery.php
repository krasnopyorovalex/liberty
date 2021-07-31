<?php

declare(strict_types=1);

namespace Domain\HowWeWork\Queries;

use App\Models\HowWeWork;

/**
 * Class GetHowWeWorkByIdQuery
 * @package Domain\HowWeWork\Queries
 */
class GetHowWeWorkByIdQuery
{
    /**
     * @var int
     */
    private int $id;

    /**
     * GetHowWeWorkByIdQuery constructor.
     * @param int $id
     */
    public function __construct(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function handle()
    {
        return HowWeWork::findOrFail($this->id);
    }
}
