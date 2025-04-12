<?php

use App\Http\Controllers\KategoriController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Auth::routes();

// route task (hanya bisa diakses jika sudah login)
Route::middleware(['auth'])->group(function () {
// route kategori
    Route::post('/kategori/store', [KategoriController::class, 'store'])->name('kategori.store');
    Route::post('/kategori/update/{id}', [KategoriController::class, 'update'])->name('kategori.update');
    Route::get('/kategori/destroy/{id}', [KategoriController::class, 'destroy'])->name('kategori.destroy');
    Route::get('/kategori/detail/{kategori}', [KategoriController::class, 'detail'])->name('kategori.detail');
// route task
    Route::get('/task/home', [TaskController::class, 'index'])->name('task');
    Route::post('/task/store', [TaskController::class, 'store'])->name('task.store');
    Route::post('/task/update/{id}', [TaskController::class, 'update'])->name('task.update');
    Route::get('/task/important', [TaskController::class, 'importantTasks'])->name('task.important');
    Route::get('/task/AsCompleted', [TaskController::class, 'completedTasks'])->name('task.AsCompleted');
    Route::post('/task/completed/{id}', [TaskController::class, 'markAsDone'])->name('task.completed');
    Route::get('/task/destroy/{id}', [TaskController::class, 'destroy'])->name('task.destroy');
    Route::get('/task/deleted', [TaskController::class, 'deletedTasks'])->name('task.deleted');
    Route::get('/task/restore/{id}', [TaskController::class, 'restore'])->name('task.restore');
    Route::get('/task/force-delete/{id}', [TaskController::class, 'forceDelete'])->name('task.forceDelete');
    Route::get('/', function () {
        return redirect('/task/home');
    });    
});

// route autentikasi


// Rute home setelah login
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
