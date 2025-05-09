<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    protected $fillable = [
        'service_id', 'name', 'image', 'description', 'start_date', 'end_date', 'has_form', 'slug'
    ];

    public function participants()
    {
        return $this->hasMany(TrainingParticipants::class);
    }
    
    public function certificates()
    {
        return $this->hasMany(Certificate::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
