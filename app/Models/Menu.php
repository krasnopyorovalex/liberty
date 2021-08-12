<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Menu
 *
 * @property int $id
 * @property string $name
 * @property string $sys_name
 * @property-read \Illuminate\Database\Eloquent\Collection|MenuItem[] $menuItems
 * @mixin \Eloquent
 **/
class Menu extends Model
{
    use HasFactory;

    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = ['name', 'sys_name'];

    /**
     * @return HasMany
     */
    public function menuItems(): HasMany
    {
        return $this->hasMany(MenuItem::class);
    }
}
