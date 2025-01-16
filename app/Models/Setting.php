<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = ['site_name', 'email', 'phone', 'address', 'about', 'site_logo', 'site_favicon', 'facebook_url', 'twitter_url', 'instagram_url', 'youtube_url'];
}
