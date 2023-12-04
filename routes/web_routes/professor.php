<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfessorController;
use App\Http\Controllers\BoletimController;
use App\Http\Controllers\TurmaMethodsController;


Route::middleware(['auth','professor'])->group(function () {

// Dashboard professor
Route::get('/professor', [ProfessorController::class, 'index'])->name('professor.index');

// Turmas routes
Route::get('/professor/turmas', [TurmaMethodsController::class, 'professor'])->name('professor.turma');

// Boletim routes
Route::get('/professor/turmas/{id}', [BoletimController::class, 'boletim'])->name('professor.boletim.view');
Route::get('/professor/turmas/editar/{id}', [BoletimController::class, 'boletimAluno'])->name('professor.boletim.aluno');
Route::post('/professor/turmas/editar/{id}', [BoletimController::class, 'update'])->name('professor.turma.boletim');
});

?>
