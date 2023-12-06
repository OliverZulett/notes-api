<?php

use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\CategoryController;
use App\Http\Controllers\api\NoteController;
use App\Http\Controllers\api\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('auth')
    ->name('auth.')
    ->group(function() {
        Route::post('/register', [AuthController::class, 'register'])->name('register');
    });

Route::prefix('users')
    ->name('users.')
    ->group(function() {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::post('/', [UserController::class, 'store'])->name('store');
        Route::get('/{user}', [UserController::class, 'show'])->name('show');
        Route::put('/{user}', [UserController::class, 'update'])->name('update');
        Route::delete('/{user}', [UserController::class, 'destroy'])->name('destroy');
    });

Route::prefix('categories')
    ->name('categories.')
    ->group(function() {
        Route::get('/', [CategoryController::class, 'index'])->name('index');
        Route::post('/', [CategoryController::class, 'store'])->name('store');
        Route::get('/{category}', [CategoryController::class, 'show'])->name('show');
        Route::put('/{category}', [CategoryController::class, 'update'])->name('update');
        Route::delete('/{category}', [CategoryController::class, 'destroy'])->name('destroy');
    });

Route::prefix('notes')
    ->name('notes.')
    ->group(function() {
        Route::get('/', [NoteController::class, 'index'])->name('index');
        Route::get('/user/{user}', [NoteController::class, 'getByUserId'])->name('getByUserId');
        Route::post('/', [NoteController::class, 'store'])->name('store');
        Route::get('/{note}', [NoteController::class, 'show'])->name('show');
        Route::put('/{note}', [NoteController::class, 'update'])->name('update');
        Route::delete('/{note}', [NoteController::class, 'destroy'])->name('destroy');
    });
