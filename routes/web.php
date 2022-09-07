<?php

use App\Http\Controllers\NoteController;
use App\Http\Controllers\NoteItemController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/* Route::get('/', function () {
    return view('welcome');
}); */

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function() {
    /* Route::post('notes', [NoteController::class, 'store'])->name('notes.store');
    Route::get('notes', [NoteController::class, 'index'])->name('notes.index');
    Route::get('notes/create', [NoteController::class, 'create'])->name('notes.create');
    Route::get('notes/edit/{note}', [NoteController::class, 'edit'])->name('notes.edit');
    Route::put('notes/update/{note}', [NoteController::class, 'update'])->name('notes.update');
    Route::get('notes/{note}', [NoteController::class, 'show'])->name('notes.show'); */

    Route::resource('/notes', NoteController::class);
    Route::resource('/notes/{note}/note-items', NoteItemController::class);
    Route::get('/', [NoteController::class, 'home'])->name('home');

});


require __DIR__.'/auth.php';
