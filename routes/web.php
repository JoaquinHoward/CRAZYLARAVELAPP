<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\FinanceController;
use App\Http\Controllers\HabitController;
use App\Http\Controllers\JournalController;

Route::middleware('guest')->group(function(){
    Route::view('/', 'welcome');
    Route::get('/register', [RegisterController::class, 'create'])->name('register');
    Route::post('/register', [RegisterController::class, 'store']);
    
    Route::get('/login', [LoginController::class, 'create'])->name('login');
    Route::post('/login', [LoginController::class, 'store']);
});

Route::middleware('auth')->group(function(){
    Route::get('/dashboard', [TaskController::class, 'index'])->name('dashboard');
    Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');

    Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
    Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('destroy');

    Route::get('/finance', [FinanceController::class, 'index'])->name('finance.index');
    Route::get('/journal', [JournalController::class, 'index'])->name('journal.index');
    Route::get('/habits', [HabitController::class, 'index'])->name('habits.index');
});