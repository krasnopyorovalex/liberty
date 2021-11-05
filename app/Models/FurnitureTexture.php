<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $path
 * @property string $label
 * @property integer $furniture_id
 */
class FurnitureTexture extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $guarded = [];
}
