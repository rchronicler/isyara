<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LessonMaterial extends Model
{
    protected $table = 'lesson_materials';

    public function lesson()
    {
        return $this->belongsTo(Lesson::class, 'lesson_id');
    }
}
