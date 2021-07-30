<?php

declare(strict_types=1);

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
class WhyChooseUs extends Model
{
    use HasFactory;

    public const STORE_PATH = 'public/why-choose-us';

    protected $guarded = ['image', 'image_mob'];

    public $timestamps = false;
}
