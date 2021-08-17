<?php

declare(strict_types=1);

namespace App\Domain\Employee\Commands;

use App\Models\Employee;

class UpdateEmployeePositionsCommand
{
    private array $positions;

    public function __construct(array $positions)
    {
        $this->positions = $positions;
    }

    public function handle(): void
    {
        foreach ($this->positions as $position => $id) {
            Employee::whereId($id)->update(['pos' => $position]);
        }
    }
}
