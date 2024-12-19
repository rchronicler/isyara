<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\LessonQuiz;

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
        // Get the first quiz of a lesson using lesson id
        $firstQuiz = (new LessonQuiz())->getFirstQuizByLessonId($id);
        $allQuizzes = (new LessonQuiz())->getAllQuizzesByLessonId($id);

        return view('learn.quiz', [
            'lesson_id' => $id,
            'quiz' => $firstQuiz,
            'quizzes' => $allQuizzes,
        ]);
    }

    public function getNextQuiz($id)
    {
        $order = request()->input('order');
        // Get the next quiz of a lesson using lesson id and order
        $nextQuiz = (new LessonQuiz())->getNextQuizByLessonId($id, $order);
        $allQuizzes = (new LessonQuiz())->getAllQuizzesByLessonId($id);

        return view('learn.quiz', [
            'lesson_id' => $id,
            'quiz' => $nextQuiz,
            'quizzes' => $allQuizzes,
        ]);
    }


    public function checkAnswer()
    {
        $quizId = request('quiz_id');
        $selectedAnswer = request('selected_answer');

        // Fetch the quiz and validate the answer
        $quiz = LessonQuiz::findOrFail($quizId);

        $isCorrect = $quiz->answer === $selectedAnswer;

        // Log the attempt (optional)
        \DB::table('user_quiz_attempts')->insert([
            'user_id' => auth()->id(),
            'quiz_id' => $quizId,
            'status' => $isCorrect,
            'attempted_at' => now(),
        ]);

        return response()->json([
            'status' => $isCorrect ? 'correct' : 'wrong',
            'message' => $isCorrect ? 'Benar! 🎉' : 'Salah!',
        ]);
    }
}
