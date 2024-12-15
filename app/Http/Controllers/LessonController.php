<?php

namespace App\Http\Controllers;

use App\Models\Lesson;

class LessonController extends Controller
{
    public function getLessonById($id)
    {
        $lesson = Lesson::with('lessonMaterials')
            ->findOrFail($id);
        return view('learn.lesson', [
            'lesson' => $lesson,
            'materials' => $lesson->lessonMaterials,
        ]);
    }

    public function getLessonQuizById($id)
    {
        $lesson = Lesson::with('lessonQuizzes')
            ->findOrFail($id);

        $options = $lesson->lessonQuizzes->pluck('options')->flatten()->all();

        return view('learn.quiz', [
            'lesson' => $lesson,
            'quizzes' => $lesson->lessonQuizzes,
            'options' => $options,
        ]);
    }
}
