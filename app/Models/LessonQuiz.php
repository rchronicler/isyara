<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LessonQuiz extends Model
{
    protected $table = 'lesson_quiz';
    protected $casts = [
        'options' => 'array', // Cast JSON to array
    ];

    public function lesson()
    {
        return $this->belongsTo(Lesson::class, 'lesson_id');
    }
}
