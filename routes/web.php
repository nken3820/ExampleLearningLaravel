<?php

use App\Http\Controllers\JobController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SessionUserController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'home');

// jobs 
Route::controller(JobController::class)->group( function () {
    Route::get('/jobs','index');
    Route::get('jobs/create','create');
    Route::post('/jobs','store');
    Route::get('/jobs/{job}','show'); 
    Route::get('/jobs/{job}/edit','edit');
    Route::patch('/jobs/{job}','update');
    Route::delete('/jobs/{job}','destroy');
});

Route::view('/contact', 'contact');

// Auth
Route::get('/register', [RegisteredUserController::class, 'create']);
Route::post('/register', [RegisteredUserController::class, 'store']);


Route::get('/login', [SessionUserController::class, 'create']);
Route::post('/login', [SessionUserController::class, 'store']);
Route::post('/logout', [SessionUserController::class, 'destroy']);