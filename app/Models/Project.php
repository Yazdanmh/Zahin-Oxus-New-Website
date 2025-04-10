<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = ['name', 'description', 'category_id', 'image', 'slug'];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
