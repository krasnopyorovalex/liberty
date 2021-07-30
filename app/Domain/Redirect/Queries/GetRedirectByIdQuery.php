<?php

declare(strict_types=1);

namespace Domain\Redirect\Queries;

use App\Models\Redirect;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class GetRedirectByIdQuery
 * @package Domain\Redirect\Queries
 */
class GetRedirectByIdQuery
{
    /**
     * @var int
     */
    private int $id;

    /**
     * GetRedirectByIdQuery constructor.
     * @param int $id
     */
    public function __construct(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return Redirect|Redirect[]|Collection|Model
     */
    public function handle()
    {
        return Redirect::findOrFail($this->id);
    }
}
