<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LessonQuiz extends Model
{
    protected $table = 'lesson_quiz';
    protected $primaryKey = 'quiz_id';
    protected $casts = [
        'options' => 'array', // Cast JSON to array
    ];

    public function lesson()
    {
        return $this->belongsTo(Lesson::class, 'lesson_id');
    }

    public function getFirstQuizByLessonId($lessonId)
    {
        return $this->where('lesson_id', $lessonId)
            ->orderBy('order', 'asc')
            ->first();
    }

    public function getAllQuizzesByLessonId($lessonId)
    {
        return $this->where('lesson_id', $lessonId)
            ->orderBy('order', 'asc')
            ->get();
    }

    public function getNextQuizByLessonId($lessonId, $order)
    {
        return $this->where('lesson_id', $lessonId)
            ->where('order', '>', $order)
            ->orderBy('order', 'asc')
            ->first();
    }
}
