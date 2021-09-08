<?php

declare(strict_types=1);

namespace Domain\Favorite\Commands;

use App\Models\Favorite;

class DestroyFavoriteCommand
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
            ->delete() > 0;
    }
}
