<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;
    protected $table = 'members';
    protected $fillable = [
        'name',
        'email',
        'phone',
        'city',
        'address',
        'study',
        'user_id'
    ];

    public $timestamps = true;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function borrowing()
    {
        return $this->hasOne(Borrowing::class);
    }
}
