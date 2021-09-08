<?php

declare(strict_types=1);

namespace Domain\Favorite\Queries;

use App\Models\Favorite;

class ExistsFavoriteQuery
{
    private int $id;
    private string $entity;

    public function __construct(int $id, string $entity)
    {
        $this->id = $id;
        $this->entity = $entity;
    }

    public function handle(): bool
    {
        return Favorite::where('entity_id', $this->id)
            ->where('entity_class', $this->entity)
            ->where('ip_address', request()->ip())
            ->where('user_agent', request()->userAgent())
            ->exists();
    }
}
