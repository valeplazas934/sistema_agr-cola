<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController; 
use App\Http\Controllers\CultivationPublicationController; 
use App\Http\Controllers\CommentController; 

// Auth routes 
    Route::get('/register', function () { return view('auth.register'); })->name('register')->middleware('guest'); 
    Route::post('/register', [UserController::class, 'register'])->middleware('guest'); 
    Route::get('/login', function () { 
    return view('auth.login'); 
    })->name('login')->middleware('guest'); 
    Route::post('/login', [UserController::class, 'login'])
    >middleware('guest'); 
    Route::post('/logout', [UserController::class, 'logout'])
    >middleware('auth')->name('logout'); 

    // Home 
    Route::get('/', function () { 
    return view('welcome'); 
    }); 
    Route::get('/home', function () { 
    return view('home'); 
    })->middleware('auth')->name('home'); 


    // Publications 
    Route::resource('publications', CultivationPublicationController::class) ->middleware(['auth']); 


    // Comments 
    Route::post('/publications/{publication}/comments', 
    [CommentController::class, 'store']) ->middleware(['auth'])->name('comments.store'); 

Route::get('/', function () {
    return view('welcome');
});
