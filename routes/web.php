<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InternalEventsController;
use App\Http\Controllers\TaskController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [HomeController::class, "index"]);
Route::get('/internal-events', [InternalEventsController::class, 'index'])->name('internal-events.index');
Route::post('/internal-events/store', [InternalEventsController::class, 'store'])->name('internal-events.store');

Route::get('/internal-events/create', [InternalEventsController::class, 'create'])->name('internal-events.create');

// Edycja
Route::get('/internal-events/{id}/edit', [InternalEventsController::class, 'edit'])->name('internal-events.edit');
Route::put('/internal-events/{id}', [InternalEventsController::class, 'update'])->name('internal-events.update');

// Usuwanie
Route::delete('/internal-events/{id}', [InternalEventsController::class, 'destroy'])->name('internal-events.destroy');

Route::resource('tasks', TaskController::class);
