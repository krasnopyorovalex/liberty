<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DoorAttribute extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $guarded = [];

    public function door(): BelongsToMany
    {
        return $this->belongsToMany(Door::class)->using(DoorHasAttribute::class);
    }

    public function doorHasAttributes(): HasMany
    {
        return $this->hasMany(DoorHasAttribute::class, 'door_attribute_id');
    }
}
