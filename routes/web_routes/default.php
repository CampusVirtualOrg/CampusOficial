<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LogonController;
use App\Http\Controllers\RequerimentosController;
use App\Http\Controllers\AccessibleController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\MessageController;


// Logon routes
Route::get('/logon', [LogonController::class, 'create']);
Route::get('/logout', [AccessibleController::class, 'index'])->name('logout');

// Profile routes
Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::patch('/profile',[ProfileController::class, 'update'])->name('profile.update');
Route::delete('/profile',[ProfileController::class, 'destroy'])->name('profile.destroy');

// reports routes
Route::get('/avisos', [PostController::class, 'index'])->name('avisos');
Route::get('/aviso/{id}', [PostController::class, 'show'])->name('avisos.show');
Route::get('/aviso/create/view', [PostController::class, 'create'])->name('avisos.create.view');
Route::post('/aviso/create', [PostController::class, 'store'])->name('avisos.create');
Route::get('/aviso/editar/{id}', [PostController::class, 'edit'])->name('avisos.edit.view');
Route::post('/aviso/update/{id}', [PostController::class, 'update'])->name('avisos.update');
Route::get('/aviso/remove/{id}', [PostController::class, 'remove'])->name('avisos.remove');

// Comments routes
Route::post('aviso/comment', [CommentController::class, 'store'])->name('comments.store');
Route::delete('aviso/comment/{id}', [CommentController::class, 'destroy'])->name('comments.remove');

// Create requeriments routes
Route::get('/requerimento/create', [RequerimentosController::class, 'index'])->name('requerimento.index');
Route::post('/requerimento/create', [RequerimentosController::class, 'create'])->name('requerimento.create');

// Chat routes
Route::get('/chat', [MessageController::class, 'index'])->name('chat.index');
Route::post('/chat', [MessageController::class, 'store'])->name('chat.store');
Route::get('/chat/{user}', [MessageController::class, 'ListMessage'])->name('chat.list');

?>
