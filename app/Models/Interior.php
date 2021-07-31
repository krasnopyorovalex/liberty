<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\Traits\AutoAliasTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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
 */
class Interior extends Model
{
    use HasFactory;
    use AutoAliasTrait;

    public const STORE_PATH = 'public/interiors';

    protected $guarded = ['image', 'image_mob'];

    /**
     * @return string
     */
    public function getUrlAttribute(): string
    {
        return route("interiors.show", $this->alias);
    }

    public function images(): HasMany
    {
        return $this->hasMany(InteriorImage::class)->orderBy('pos');
    }
}
