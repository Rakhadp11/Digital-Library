<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    protected $table = 'questions';
    protected $fillable = [
        'id',
        'quiz_id',
        'question_text',
        'correct_answer',
        'options',
        'image'
    ];

    protected $casts = [
        'options' => 'array',
    ];
    public $timestamps = true;

    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }
}
