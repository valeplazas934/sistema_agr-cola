<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CultivationPublicationController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\CultivationController as AdminCultivationController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Página de inicio
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home', [HomeController::class, 'index'])->name('home');

// Perfil de usuario
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/profile/show', [ProfileController::class, 'show'])->name('profile.show');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::patch('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');

    // Todas las rutas CRUD de CultivationPublication ya quedan cubiertas
    Route::resource('cultivations', CultivationPublicationController::class);

    // Categorías (solo accesibles por usuarios autenticados)
    Route::resource('categories', CategoryController::class);

    Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::get('/comments/{comment}/edit', [CommentController::class, 'edit'])->name('comments.edit');
    Route::put('/comments/{comment}', [CommentController::class, 'update'])->name('comments.update');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');

});

Route::get('/admin', [AdminController::class, 'index'])->middleware(['auth', 'admin'])->name('admin.dashboard');

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    //Route::get('/', [AdminController::class, 'index'])->name('dashboard');

    Route::resource('users', AdminUserController::class);
    Route::resource('cultivations', AdminCultivationController::class);
    Route::resource('categories', AdminCategoryController::class);
});

require __DIR__.'/auth.php';
