<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\SliderImage
 *
 * @property int $id
 * @property int $furniture_interior_slider_id
 * @property string|null $name
 * @property string $link
 * @property string|null $alt
 * @property string|null $title
 * @property string $basename
 * @property string $ext
 * @property string $is_published
 * @property int $pos
 * @property string $is_mobile
 */
class FurnitureInteriorSliderImage extends Model
{
    use HasFactory;

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
        return $this->belongsTo(FurnitureInteriorSlider::class);
    }

    /**
     * @return string
     */
    public function getThumb(): string
    {
        return asset('storage/furniture-interior-slider/' . $this->furniture_interior_slider_id . '/' . $this->basename . '_thumb.' . $this->ext);
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return asset('storage/furniture-interior-slider/' . $this->furniture_interior_slider_id . '/' . $this->basename . '.' . $this->ext);
    }
}
