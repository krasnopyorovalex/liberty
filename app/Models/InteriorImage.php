<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $interior_id
 * @property string $basename
 * @property string $ext
 * @property string $is_mobile
 */
class InteriorImage extends Model
{
    public $timestamps = false;

    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * @return BelongsTo
     */
    public function interior(): BelongsTo
    {
        return $this->belongsTo(Interior::class);
    }

    /**
     * @return string
     */
    public function getThumb(): string
    {
        return asset('storage/interiors/' . $this->interior_id . '/' . $this->basename . '_thumb.' . $this->ext);
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return asset('storage/interiors/' . $this->interior_id . '/' . $this->basename . '.' . $this->ext);
    }
}
