<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\TaskController;

use App\Http\Controllers\FinanceController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ExpenseController;

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
    Route::delete('/tasks/completed', [TaskController::class, 'destroyCompleted'])->name('tasks.destroyCompleted');
    Route::delete('/tasks/current', [TaskController::class, 'destroyCurrent'])->name('tasks.destroyCurrent');
    Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');
    Route::patch('/task/{task}', [TaskController::class, 'update'])->name('tasks.update');
    Route::get('/tasks/{task}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
    
    Route::get('/finance', [FinanceController::class, 'index'])->name('finance.index');
    Route::post('/finance', [FinanceController::class, 'create']);

    Route::post('/category', [CategoryController::class, 'store'])->name('category.store');
    Route::patch('/category/{category}', [CategoryController::class, 'update'])->name('category.update');
    Route::post('/expense', [ExpenseController::class, 'store'])->name('expense.store');

    Route::get('/journal', [JournalController::class, 'index'])->name('journal.index');
    Route::get('/habits', [HabitController::class, 'index'])->name('habits.index');
});