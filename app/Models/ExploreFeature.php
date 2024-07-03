<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExploreFeature extends Model
{
    use HasFactory;
    protected $table = 'explore-features';
    protected $fillable = [
        'id',
        'title',
        'deskripsi',
        'card_title',
        'card_deskripsi',
        'button',
        'image',
    ];

    public $timestamps = true;
}
