<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hero extends Model
{
    protected $fillable = ['title', 'subtitle', 'description', 'image_1', 'image_2', 'image_3', 'button', 'link'];
}
