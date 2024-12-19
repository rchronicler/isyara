<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubmissionController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\UserSavedWordController;
use App\Models\Category;
use App\Models\Submission;
use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $categories = Category::latest()->get();
    return view('welcome', compact('categories'));
})->name('home');

Route::middleware(['auth', 'verified', 'role:volunteer'])->group(function () {
    Route::prefix('dashboard')->group(function () {
        // dashboard
        Route::get('/', function () {
            return view('dashboard.dashboard');
        })->name('dashboard');

        // dashboard/submissions
        // https://laravel.com/docs/11.x/controllers#resource-controllers
        Route::resource('submissions', SubmissionController::class);
    });
});

Route::get('/learn', function () {
    $lessons = Lesson::get();
    return view('learn.learn', compact('lessons'));
})->name('learn');

Route::get('/learn/{lesson}', [LessonController::class, 'getLessonById'])->name('learn');
Route::get('/learn/{lesson}/quiz', [LessonController::class, 'getLessonQuizById'])->name('learn');
Route::post('/learn/{lesson}/quiz/next', [LessonController::class, 'getNextQuiz'])->name('next-quiz');
Route::post('/check-answer', [LessonController::class, 'checkAnswer'])->name('check-answer');

Route::get('/dictionary', [SubmissionController::class, 'getDictionary'])->name('dictionary');
Route::get('/dictionary/{entry_id}', [SubmissionController::class, 'getDictionaryById'])->name('dictionary-by-id');

Route::middleware('auth')->group(function () {
    Route::post('/save-word', [UserSavedWordController::class, 'store'])->name('save-word');
    Route::get('/saved-words', [UserSavedWordController::class, 'index'])->name('saved-words');
    Route::delete('/saved-words/{saved_id}', [UserSavedWordController::class, 'destroy'])->name('saved-words.destroy');
});

// Search returns JSON
Route::get('/search', function (Request $request) {
    return Submission::search($request->input('q'))->get();
})->name('search');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
