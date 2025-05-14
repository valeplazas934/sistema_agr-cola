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

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/profile/show', [ProfileController::class, 'show'])->name('profile.show');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::patch('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/cultivations', [CultivationPublicationController::class, 'index'])
        ->name('cultivations.index');
});
Route::get('/cultivations/{publication}', [CultivationPublicationController::class, 'show'])
->name('cultivations.show');
Route::get('/cultivations/{publication}', [CultivationPublicationController::class, 'show'])
->name('cultivations.create');
Route::get('/cultivations/{publication}', [CultivationPublicationController::class, 'show'])
->name('cultivations.edit');

// Ruta para mostrar todas las categorías
Route::get('categories', [CategoryController::class, 'index'])->name('categories.index');

// Ruta para mostrar una categoría específica
Route::get('categories/{category}', [CategoryController::class, 'show'])->name('categories.show');

require __DIR__.'/auth.php';
