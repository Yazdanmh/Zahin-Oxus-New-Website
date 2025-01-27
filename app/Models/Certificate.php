<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    protected $fillable = [
        'training_id',
        'certificate_code',
        'certificate_name',
        'issue_date',
        'for_who',
    ];

    public function training()
    {
        return $this->belongsTo(Training::class);
    }
}
