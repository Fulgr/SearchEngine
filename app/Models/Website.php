<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Website extends Model
{
    use HasFactory;

    protected $fillable = ['url', 'title', 'description', 'type_id'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($website) {
            $url = parse_url($website->url);
            $website->favicon = $url['scheme'].'://'.$url['host'].'/favicon.ico';
        });
    }
}
