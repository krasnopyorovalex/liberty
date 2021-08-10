<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tab extends Model
{
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = ['name'];
}
