<?php

declare(strict_types=1);

namespace App\Contracts;

interface Favorite
{
    public function add(int $id, string $entity): bool;

    public function remove(int $id, string $entity): bool;

    public function exists(int $id, string $entity): bool;

    public function list();
}
