<?php

declare(strict_types=1);

namespace App\Services;

use App\Contracts\Favorite;
use Domain\Favorite\Commands\AddToFavoriteCommand;
use Domain\Favorite\Commands\DestroyFavoriteCommand;
use Domain\Favorite\Queries\ExistsFavoriteQuery;
use Domain\Favorite\Queries\GetFavoriteListQuery;
use Illuminate\Foundation\Bus\DispatchesJobs;

final class SqlFavorite implements Favorite
{
    use DispatchesJobs;

    public function add(int $id, string $entity): bool
    {
        return $this->dispatch(new AddToFavoriteCommand($id, $entity));
    }

    public function remove(int $id, string $entity): bool
    {
        return $this->dispatch(new DestroyFavoriteCommand($id, $entity));
    }

    public function exists(int $id, string $entity): bool
    {
        return $this->dispatch(new ExistsFavoriteQuery($id, $entity));
    }

    public function list()
    {
        return $this->dispatch(new GetFavoriteListQuery());
    }
}
