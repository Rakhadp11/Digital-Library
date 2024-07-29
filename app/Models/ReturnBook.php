<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReturnBook extends Model
{
    use HasFactory;
    protected $table = 'return_books';

    protected $fillable = [
        'book_id',
        'user_id',
        'borrowed_at',
        'returned_at',
    ];

    public function borrowing()
    {
        return $this->belongsTo(Borrowing::class);
    }
}
