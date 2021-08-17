<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\Traits\AutoAliasTrait;
use App\Scopes\WithUsersByMyGroupsScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Str;

/**
 * @property int $id
 * @property string $image
 * @property string $image_mob
 * @property string $alias
 * @property string $file
 * @property int $price
 * @property \Illuminate\Database\Eloquent\Collection $doorAttributes
 */
class Door extends Model
{
    use HasFactory;
    use AutoAliasTrait;

    public const STORE_PATH = 'public/doors';

    protected $guarded = ['image', 'image_mob', 'doorAttribute.*', 'file'];

    protected $casts = [
        'finishing_options' => 'array',
        'finishing_option_names' => 'array'
    ];

    public static function boot(): void
    {
        parent::boot();

        static::created(static function ($model) {
            DoorInteriorSlider::create([
                'name' => $model->name,
                'door_id' => $model->id
            ]);
        });

        static::deleting(static function ($model) {
            DoorInteriorSlider::whereDoorId($model->id)->delete();
        });
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class);
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Door::class, 'parent_id');
    }

    public function doorAttributes(): BelongsToMany
    {
        return $this->belongsToMany(DoorAttribute::class, 'door_has_attributes')
            ->withPivot('value')
            ->using(DoorHasAttribute::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(DoorImage::class)->where('is_mobile', '0')->orderBy('pos');
    }

    public function imagesForMobile(): HasMany
    {
        return $this->hasMany(DoorImage::class)->where('is_mobile', '1')->orderBy('pos');
    }

    public function doorInteriorSlider(): HasOne
    {
        return $this->hasOne(DoorInteriorSlider::class, 'door_id');
    }

    /**
     * @return string
     */
    public function getUrlAttribute(): string
    {
        return route("door.show", $this->alias);
    }

    public function getDoorAttributeValue(int $doorAttributeId): string
    {
        return $this->doorAttributes->firstWhere('id', $doorAttributeId)
            ? $this->doorAttributes->firstWhere('id', $doorAttributeId)->pivot->value
            : '';
    }

    public function attachDoorAttributes(array $doorAttributes)
    {
        foreach ($doorAttributes as $key => $value) {
            if ($value) {
                DoorHasAttribute::create([
                    'door_id' => $this->id,
                    'door_attribute_id' => (int)$key,
                    'value' => (string)$value
                ]);
            }
        }
    }

    /**
     * @return string
     */
    public function getPrice(): string
    {
        return sprintf('%s &#8381;', number_format($this->price, 0, '.', ' '));
    }
}
