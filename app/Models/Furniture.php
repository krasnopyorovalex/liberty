<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\Traits\AutoAliasTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $image
 * @property string $image_mob
 * @property string $alias
 * @property string $file
 * @property \Illuminate\Database\Eloquent\Collection $furnitureAttributes
 */
class Furniture extends Model
{
    use AutoAliasTrait;
    use HasFactory;

    public const STORE_PATH = 'public/furniture';

    protected $casts = [
        'finishing_options' => 'array'
    ];

    protected $guarded = ['image', 'image_mob', 'furnitureAttribute.*', 'file'];

    public function images(): HasMany
    {
        return $this->hasMany(FurnitureImage::class)->where('is_mobile', '0')->orderBy('pos');
    }

    public function imagesForMobile(): HasMany
    {
        return $this->hasMany(FurnitureImage::class)->where('is_mobile', '1')->orderBy('pos');
    }

    public function furnitureType(): BelongsTo
    {
        return $this->belongsTo(FurnitureType::class);
    }

    public function collection(): BelongsTo
    {
        return $this->belongsTo(Collection::class);
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class);
    }

    public function furnitureAttributes(): BelongsToMany
    {
        return $this->belongsToMany(FurnitureAttribute::class, 'furniture_has_attributes')
            ->withPivot('value')
            ->using(FurnitureHasAttributes::class);
    }

    /**
     * @return string
     */
    public function getUrlAttribute(): string
    {
        return route("furniture.show", $this->alias);
    }

    public function getFurnitureAttributeValue(int $furnitureAttributeId): string
    {
        return $this->furnitureAttributes->firstWhere('id', $furnitureAttributeId)
            ? $this->furnitureAttributes->firstWhere('id', $furnitureAttributeId)->pivot->value
            : '';
    }

    public function attachFurnitureAttributes(array $furnitureAttributes)
    {
        foreach ($furnitureAttributes as $key => $value) {
            if ($value) {
                FurnitureHasAttributes::create([
                    'furniture_id' => $this->id,
                    'furniture_attribute_id' => (int) $key,
                    'value' => (string) $value
                ]);
            }
        }
    }
}
