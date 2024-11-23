<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubmissionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

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

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
