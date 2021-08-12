<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class InteriorType extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $guarded = [];

    public function interiors(): HasMany
    {
        return $this->hasMany(Interior::class);
    }
}
