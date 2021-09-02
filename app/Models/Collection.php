<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\Traits\AutoAliasTrait;
use App\Models\Traits\Images;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Collection
 * @package App\Models
 *
 * @property int $id
 * @property string $alias
 * @property string $text
 * @property string $image
 * @property string $image_mob
 * @property string $catalog_file
 * @property \Illuminate\Database\Eloquent\Collection $furniture
 */
class Collection extends Model
{
    use HasFactory;
    use AutoAliasTrait;
    use Images;

    public const STORE_PATH = 'public/collections';

    protected $guarded = ['image', 'image_mob', 'catalog_file'];

    public function furniture(): HasMany
    {
        return $this->hasMany(Furniture::class);
    }

    /**
     * @return string
     */
    public function getUrlAttribute(): string
    {
        return route("collection.show", $this->alias);
    }

    public function images(): HasMany
    {
        return $this->hasMany(CollectionImage::class)->where('is_mobile', '0')->orderBy('pos');
    }

    public function imagesForMobile(): HasMany
    {
        return $this->hasMany(CollectionImage::class)->where('is_mobile', '1')->orderBy('pos');
    }
}
