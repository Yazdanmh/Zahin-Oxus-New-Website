<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CEO extends Model
{
    protected $fillable = [
        'name',
        'position',
        'email',
        'phone',
        'image',
        'description',
        'skills',
        'slug',
    ];

    protected $casts = [
        'skills' => 'array',
    ];
}
