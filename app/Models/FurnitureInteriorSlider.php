<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FurnitureInteriorSlider extends Model
{
    use HasFactory;

    public $timestamps = false;

    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * @return HasMany
     */
    public function images(): HasMany
    {
        return $this->hasMany(FurnitureInteriorSliderImage::class)->where('is_mobile', '0')->orderBy('pos');
    }

    /**
     * @return HasMany
     */
    public function imagesForMobile(): HasMany
    {
        return $this->hasMany(FurnitureInteriorSliderImage::class)->where('is_mobile', '1')->orderBy('pos');
    }

    public function furniture(): BelongsTo
    {
        return $this->belongsTo(Furniture::class);
    }
}
