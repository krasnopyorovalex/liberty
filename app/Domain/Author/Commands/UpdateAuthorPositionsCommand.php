<?php

declare(strict_types=1);

namespace App\Domain\Author\Commands;

use App\Models\Author;

class UpdateAuthorPositionsCommand
{
    private array $positions;

    public function __construct(array $positions)
    {
        $this->positions = $positions;
    }

    public function handle(): void
    {
        foreach ($this->positions as $position => $id) {
            Author::whereId($id)->update(['pos' => $position]);
        }
    }
}
