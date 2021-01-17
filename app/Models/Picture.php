<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'date',
        'url',
        'hdurl',
        'thumbs',
        'media_type',
        'explanation',
        'copyright'
    ];

    public function likes() {
        return $this->hasMany('App\Models\Like');
    }
}
