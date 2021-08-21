<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\Traits\AutoAliasTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;

/**
 * Class Page
 * @package App\Models
 *
 * @property int $id
 * @property string $alias
 * @property string $text
 * @property string $template
 * @property string $image_mob
 */
class Page extends Model
{
    use HasFactory;
    use AutoAliasTrait;

    public const STORE_PATH = 'public/pages';

    private const TEMPLATES = [
        'page.index' => 'Главная',
        'page.about' => 'О нас',
        'page.doors' => 'Двери',
        'page.furniture' => 'Мебель',
        'page.interiors' => 'Интерьер',
        'page.clients' => 'Клиентам',
        'page.contacts' => 'Контакты',
    ];

    /**
     * @var array
     */
    protected $guarded = ['image', 'image_mob'];

    /**
     * @return MorphOne
     */
    public function image(): MorphOne
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function slider(): BelongsTo
    {
        return $this->belongsTo(Slider::class);
    }

    /**
     * @return string
     */
    public function getUrlAttribute(): string
    {
        return route("page.show", str_replace('index', '', $this->alias));
    }

    /**
     * @return array
     */
    public function getTemplates(): array
    {
        return self::TEMPLATES;
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopePublish($query)
    {
        return $query->where('is_published', '1');
    }
}
