<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $table = 'books';
    protected $fillable = [
        'id',
        'title',
        'category',
        'cover_image',
        'author',
        'publisher',
        'year',
        'pages',
        'description',
        'pdf_file',
        'is_available',  
    ];

    public function borrowings()
    {
        return $this->hasMany(Borrowing::class);
    }
}