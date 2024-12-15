<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubmissionController;
use App\Http\Controllers\LessonController;
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

Route::get('/dictionary', [SubmissionController::class, 'getDictionary'])->name('dictionary');

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
