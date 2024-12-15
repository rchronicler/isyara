<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\LessonMaterial;
use App\Models\LessonQuiz;

class Lesson extends Model
{
    protected $table = 'lessons';
    protected $primaryKey = 'lesson_id';
    public function lessonMaterials()
    {
        return $this->hasMany(LessonMaterial::class, 'lesson_id')
            ->orderBy('order');
    }

    public function lessonQuizzes()
    {
        return $this->hasMany(LessonQuiz::class, 'lesson_id');
    }
}
