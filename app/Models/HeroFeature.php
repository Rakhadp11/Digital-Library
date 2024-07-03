<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeroFeature extends Model
{
    use HasFactory;
    protected $table = 'hero-features';
    protected $fillable = [
        'id',
        'title',
        'button',
    ];

    public $timestamps = true;
}
