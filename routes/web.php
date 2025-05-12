<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CultivationPublicationController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/
// Página de inicio
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    // Página de inicio
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/', function () {
    return view('welcome');
    });
    // Rutas de perfil (proporcionadas por Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Rutas para publicaciones de cultivo
    Route::resource('cultivation', CultivationPublicationController::class);
    Route::resource('publications', CultivationPublicationController::class);
    
    // Rutas para comentarios
    Route::post('/cultivation/{cultivation}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
    
    // Rutas para categorías
    Route::resource('categories', CategoryController::class);
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    
    // Rutas para publicaciones (Cultivation Publication)
    Route::resource('publications', PublicationController::class);
    
    // Rutas para comentarios
    Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::get('/comments/{id}', [CommentController::class, 'show'])->name('comments.show');
});


require __DIR__.'/auth.php';
