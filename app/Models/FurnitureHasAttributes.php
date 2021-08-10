<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class FurnitureHasAttributes extends Pivot
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'furniture_has_attributes';
}
