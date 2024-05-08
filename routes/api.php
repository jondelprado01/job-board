<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


Route::get('/job-list', [App\Http\Controllers\JobBoardController::class, 'jobList']);
Route::post('/add-job', [App\Http\Controllers\JobBoardController::class, 'addJob']);
Route::post('/edit-job-post/{id}', [App\Http\Controllers\JobBoardController::class, 'editJob']);