<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['title'];
    public function projects()
    {
        return $this->hasMany(Project::class);
    }
    public function portfolios(){
        return $this->hasMany(Portfolio::class); 
    }
}
