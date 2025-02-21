<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrainingParticipants extends Model
{
    protected $fillable = ['training_id', 'full_name', 'email', 'phone_number', 'taskira_number', 'address', 'position', 'organization'];
    
    public function training()
    {
        return $this->belongsTo(Training::class);
    }
}