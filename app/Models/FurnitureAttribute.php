<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FurnitureAttribute extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $guarded = [];

    public function furniture(): BelongsToMany
    {
        return $this->belongsToMany(Furniture::class)->using(FurnitureHasAttributes::class);
    }

    public function furnitureHasAttributes(): HasMany
    {
        return $this->hasMany(FurnitureHasAttributes::class, 'furniture_attribute_id');
    }
}
