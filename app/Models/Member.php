<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Member extends Model
{
    protected $fillable = [
        'name',
        'position',
        'email',
        'phone',
        'image',
        'description',
        'facebook',
        'twitter',
        'skills',
        'slug',
    ];

    // Ensure 'skills' is treated as an array
    protected $casts = [
        'skills' => 'array',
    ];
}

