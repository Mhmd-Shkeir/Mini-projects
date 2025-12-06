<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'genre',
        'year',
        'duration',
        'poster_url',
    ];

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
