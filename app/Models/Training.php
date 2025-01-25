<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    protected $fillable = ['name', 'image', 'description', 'start_date', 'end_date', 'has_form', 'slug'];
}
