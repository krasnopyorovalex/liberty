<?php

declare(strict_types=1);

namespace App\Http\Controllers\Traits;

use Domain\Favorite\Queries\ExistsFavoriteQuery;

trait HasFavorites
{
    /**
     * @param int $id
     * @param string $entity
     * @return bool
     */
    public function isFavorite(int $id, string $entity): bool
    {
        return $this->dispatch(new ExistsFavoriteQuery($id, $entity));
    }
}
