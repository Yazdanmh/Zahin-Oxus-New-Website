<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'subtitle', 'image', 'icon', 'description', 'slug', 'service_category_id'];
    public function category()
    {
        return $this->belongsTo(ServiceCategory::class, 'service_category_id');
    }
    public function trainings()
    {
        return $this->hasMany(Training::class);
    }
    public function trainers()
    {
        return $this->hasMany(Member::class);  
    }
}
