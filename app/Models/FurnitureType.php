<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FurnitureType extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $guarded = [];

    public function furniture(): HasMany
    {
        return $this->hasMany(Furniture::class);
    }
}
