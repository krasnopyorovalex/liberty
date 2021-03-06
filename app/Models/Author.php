<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\Traits\AutoAliasTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

/**
 * Class Page
 * @package App\Models
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $name
 * @property string $alias
 * @property string $text
 * @property int $pos
 */
class Author extends Model
{
    use HasFactory;
    use AutoAliasTrait;

    public $timestamps = false;

    protected $guarded = ['image'];

    /**
     * @return MorphOne
     */
    public function image(): MorphOne
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function furniture(): HasMany
    {
        return $this->hasMany(Furniture::class);
    }

    public function interiors(): HasMany
    {
        return $this->hasMany(Interior::class);
    }

    public function doors(): HasMany
    {
        return $this->hasMany(Door::class);
    }

    /**
     * @return string
     */
    public function getUrlAttribute(): string
    {
        return route("author.show", $this->alias);
    }
}
