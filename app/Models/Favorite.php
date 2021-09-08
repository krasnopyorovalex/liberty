<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $entity_id
 * @property string $entity_class
 * @property string $ip_address
 * @property string $user_agent
 */
class Favorite extends Model
{
    use HasFactory;

    protected $guarded = [];
}
