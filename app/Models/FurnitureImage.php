<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $furniture_id
 * @property string $basename
 * @property string $ext
 */
class FurnitureImage extends Model
{
    use HasFactory;

    public $timestamps = [];

    protected $guarded = [];

    /**
     * @return BelongsTo
     */
    public function furniture(): BelongsTo
    {
        return $this->belongsTo(Furniture::class);
    }

    /**
     * @return string
     */
    public function getThumb(): string
    {
        return asset('storage/furniture/' . $this->furniture_id . '/' . $this->basename . '_thumb.' . $this->ext);
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return asset('storage/furniture/' . $this->furniture_id . '/' . $this->basename . '.' . $this->ext);
    }
}
