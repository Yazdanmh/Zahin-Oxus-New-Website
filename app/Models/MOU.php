<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MOU extends Model
{
    protected $fillable = ['title', 'description', 'parties_involved', 'start_date', 'end_date', 'mou_file', 'status', 'slug'];
}
