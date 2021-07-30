<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Page
 *
 * @property int $id
 * @property string $url_old
 * @property string $url_new
 * @mixin \Eloquent
 */
class Redirect extends Model
{
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = ['url_old', 'url_new'];
}
