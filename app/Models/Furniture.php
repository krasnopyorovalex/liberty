<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\Traits\AutoAliasTrait;
use App\Models\Traits\Images;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property int $id
 * @property string $image
 * @property string $image_mob
 * @property string $alias
 * @property string $file
 * @property int $price
 * @property int $collection_id
 * @property \Illuminate\Database\Eloquent\Collection $furnitureAttributes
 */
class Furniture extends Model
{
    use AutoAliasTrait;
    use HasFactory;
    use Images;

    public const STORE_PATH = 'public/furniture';

    public const WIDTH = 376;
    public const HEIGHT = 371;

    public const WIDTH_MOBILE = 340;
    public const HEIGHT_MOBILE = 450;

    protected $perPage = 18;

    protected $with = ['textures'];

    protected $casts = [
        'finishing_options' => 'array'
    ];

    protected $guarded = ['image', 'image_mob', 'furnitureAttribute.*', 'file'];

    public static function boot(): void
    {
        parent::boot();

        static::created(static function ($model) {
            FurnitureInteriorSlider::create([
                'name' => $model->name,
                'furniture_id' => $model->id
            ]);
        });

        static::deleting(static function ($model) {
            FurnitureInteriorSlider::whereFurnitureId($model->id)->delete();
        });
    }

    public function images(): HasMany
    {
        return $this->hasMany(FurnitureImage::class)->orderBy('pos');
    }

    public function textures(): HasMany
    {
        return $this->hasMany(FurnitureTexture::class, 'furniture_id');
    }

    public function furnitureInteriorSlider(): HasOne
    {
        return $this->hasOne(FurnitureInteriorSlider::class, 'furniture_id');
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

    /**
     * @return string
     */
    public function getPrice(): string
    {
        return sprintf('%s ₽', number_format($this->price, 0, '.', ' '));
    }
}
