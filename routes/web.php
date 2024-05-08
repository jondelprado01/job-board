<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/job-listing', [App\Http\Controllers\JobBoardController::class, 'jobListing'])->name('job-listing');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    Route::get('/', [App\Http\Controllers\JobBoardController::class, 'jobPost'])->name('job-post');
    Route::get('/view-job/{id}', [App\Http\Controllers\JobBoardController::class, 'viewJobPost'])->name('view-job-post');

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
