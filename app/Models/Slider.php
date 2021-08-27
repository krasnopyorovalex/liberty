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
 * @property \Illuminate\Database\Eloquent\Collection $images
 * @property \Illuminate\Database\Eloquent\Collection $imagesForMobile
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
        return $this->hasMany(SliderImage::class)->where('is_mobile', '0')->orderBy('pos');
    }

    /**
     * @return HasMany
     */
    public function imagesForMobile(): HasMany
    {
        return $this->hasMany(SliderImage::class)->where('is_mobile', '1')->orderBy('pos');
    }
}
