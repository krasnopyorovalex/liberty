<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $door_id
 * @property string $basename
 * @property string $ext
 * @property string $is_mobile
 */
class DoorImage extends Model
{
    use HasFactory;

    public $timestamps = [];

    protected $guarded = [];

    /**
     * @return BelongsTo
     */
    public function furniture(): BelongsTo
    {
        return $this->belongsTo(Door::class);
    }

    /**
     * @return string
     */
    public function getThumb(): string
    {
        return asset('storage/doors/' . $this->door_id . '/' . $this->basename . '_thumb.' . $this->ext);
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return asset('storage/doors/' . $this->door_id . '/' . $this->basename . '.' . $this->ext);
    }
}
