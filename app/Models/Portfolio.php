<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    protected $fillable = ['title', 'category_id', 'image', 'description', 'date', 'has_form']; 
    public function category(){
        return $this->belongsTo(Category::class); 
    }
}
