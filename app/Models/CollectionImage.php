<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $collection_id
 * @property string $basename
 * @property string $ext
 * @property string $is_mobile
 */
class CollectionImage extends Model
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
        return asset('storage/collections/' . $this->collection_id . '/' . $this->basename . '_thumb.' . $this->ext);
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return asset('storage/collections/' . $this->collection_id . '/' . $this->basename . '.' . $this->ext);
    }
}
