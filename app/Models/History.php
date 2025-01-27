<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    protected $casts = [
        'progress_items' => 'array',
    ];
    protected $fillable = ['title', 'subtitle', 'description', 'image_one', 'image_two', 'progress_items'];
}

