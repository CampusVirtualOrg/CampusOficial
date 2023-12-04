<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlunoController;

Route::middleware('aluno')->group(function () {

		// Alunos routes
		Route::get('/aluno', [AlunoController::class, 'index'])->name('aluno.index');
		Route::get('/boletim', [AlunoController::class, 'boletim'])->name('aluno.boletim');
		Route::get('/minhasdisciplinas', [AlunoController::class, 'disciplinas'])->name('aluno.disciplinas');
	});
