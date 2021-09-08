<?php

declare(strict_types=1);

namespace Domain\Favorite\Queries;

use App\Models\Favorite;

class GetFavoriteListQuery
{
    /**
     * @return mixed
     */
    public function handle()
    {
        return Favorite::where('ip_address', request()->ip())
            ->where('user_agent', request()->userAgent())
            ->get();
    }
}
