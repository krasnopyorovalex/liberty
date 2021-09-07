<?php

declare(strict_types=1);

namespace App\Contracts;

interface Favorite
{
    public function add();

    public function remove(int $id, string $entity);
}
