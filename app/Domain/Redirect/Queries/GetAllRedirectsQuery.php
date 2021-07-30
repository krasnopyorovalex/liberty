<?php

declare(strict_types=1);

namespace Domain\Redirect\Queries;

use App\Models\Redirect;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class GetAllRedirectsQuery
 * @package Domain\Redirect\Queries
 */
class GetAllRedirectsQuery
{
    /**
     * @return Redirect[]|Collection
     */
    public function handle()
    {
        return Redirect::all();
    }
}
