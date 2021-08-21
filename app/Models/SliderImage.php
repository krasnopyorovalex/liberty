<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\SliderImage
 *
 * @property int $id
 * @property int $slider_id
 * @property string|null $name
 * @property string $link
 * @property string|null $alt
 * @property string|null $title
 * @property string $basename
 * @property string $ext
 * @property string $is_published
 * @property int $pos
 * @property string $is_mobile
 * @mixin \Eloquent
 */
class SliderImage extends Model
{
    public $timestamps = false;

    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * @return BelongsTo
     */
    public function slider(): BelongsTo
    {
        return $this->belongsTo(Slider::class);
    }

    /**
     * @return string
     */
    public function getThumb(): string
    {
        return asset('storage/slider/' . $this->slider_id . '/' . $this->basename . '_thumb.' . $this->ext);
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return asset('storage/slider/' . $this->slider_id . '/' . $this->basename . '.' . $this->ext);
    }
}
