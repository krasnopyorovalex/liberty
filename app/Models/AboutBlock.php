<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property string $text
 * @property string $image
 * @property string $image_mob
 */
class AboutBlock extends Model
{
    use HasFactory;

    public const STORE_PATH = 'public/about-blocks';

    protected $guarded = ['image', 'image_mob'];

    public $timestamps = false;
}
