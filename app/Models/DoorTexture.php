<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property string $path
 * @property string $label
 * @property integer $door_id
 */
class DoorTexture extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $guarded = [];

    public function door(): BelongsTo
    {
        return $this->belongsTo(Door::class);
    }
}
