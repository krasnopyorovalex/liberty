<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Slider
 *
 * @property int $id
 * @property string $name
 * @property string $is_published
 * @property int $pos
 */
class Slider extends Model
{
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = ['name', 'is_published'];

    /**
     * @return HasMany
     */
    public function images(): HasMany
    {
        return $this->hasMany(SliderImage::class)->orderBy('pos');
    }
}
