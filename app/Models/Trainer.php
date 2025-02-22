<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trainer extends Model
{
    protected $fillable = [
        'service_id',
        'name',
        'position',
        'email',
        'phone',
        'image',
        'description',
        'skills',
        'slug',
        'show_on_home',
    ];

    protected $casts = [
        'skills' => 'array',
    ];
    public function service()
    {
        return $this->belongsTo(Service::class);  
    }
}
