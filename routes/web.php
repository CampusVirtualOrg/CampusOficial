<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccessibleController;


Route::get('/', [AccessibleController::class, 'index'])->name('welcome');
Route::middleware('auth')->group(function () {

	require __DIR__ . '/web_routes/adm.php';		// Administrador
	require __DIR__ . '/web_routes/aluno.php';		// Aluno
	require __DIR__ . '/web_routes/default.php';	// Default
	require __DIR__ . '/web_routes/professor.php';	// Professor

});

require __DIR__ . '/auth.php';
