<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\Traits\AutoAliasTrait;
use App\Models\Traits\Images;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Interior
 * @package App\Models
 *
 * @property int $id
 * @property string $alias
 * @property string $text
 * @property string $image
 * @property string $image_mob
 * @property string $image_premium_slider
 * @property string $image_premium_slider_mob
 */
class Interior extends Model
{
    use HasFactory;
    use AutoAliasTrait;
    use Images;

    public const STORE_PATH = 'public/interiors';

    protected $guarded = ['image', 'image_mob'];

    /**
     * @return string
     */
    public function getUrlAttribute(): string
    {
        return route("interior.show", $this->alias);
    }

    public function images(): HasMany
    {
        return $this->hasMany(InteriorImage::class)->orderBy('pos');
    }

    public function interiorType(): BelongsTo
    {
        return $this->belongsTo(InteriorType::class);
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class);
    }
}
