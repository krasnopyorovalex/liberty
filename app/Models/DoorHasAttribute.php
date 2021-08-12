<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class DoorHasAttribute extends Pivot
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'door_has_attributes';
}
