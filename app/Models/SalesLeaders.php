<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\Traits\AutoAliasTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Page
 * @package App\Models
 *
 * @property int $id
 * @property string $alias
 * @property string $text
 * @property string $image
 * @property string $image_mob
 */
class SalesLeaders extends Model
{
    use HasFactory;
    use AutoAliasTrait;

    public const STORE_PATH = 'public/sales_leaders';

    protected $guarded = [];

    /**
     * @return string
     */
    public function getUrlAttribute(): string
    {
        return route("sales_leader.show", $this->alias);
    }
}
