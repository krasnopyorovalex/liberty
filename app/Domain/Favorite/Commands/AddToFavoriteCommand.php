<?php

declare(strict_types=1);

namespace Domain\Favorite\Commands;

use App\Models\Favorite;

class AddToFavoriteCommand
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
        Favorite::firstOrCreate([
            'entity_id' => $this->id,
            'entity_class' => $this->entity,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent()
        ]);

        return true;
    }
}
