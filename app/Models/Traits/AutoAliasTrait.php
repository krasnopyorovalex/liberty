<?php

declare(strict_types=1);

namespace App\Models\Traits;

use Illuminate\Support\Str;

/**
 * Trait AutoAliasTrait
 * @package App
 */
trait AutoAliasTrait
{
    /**
     * @param string $value
     */
    public function setAliasAttribute(string $value): void
    {
        $this->attributes['alias'] = Str::slug($value);
    }
}
