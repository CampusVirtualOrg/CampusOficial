<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\BoletimController;
use App\Http\Controllers\RequerimentosController;
use App\Http\Controllers\CursosController;
use App\Http\Controllers\DisciplinasController;
use App\Http\Controllers\TurmaController;
use App\Http\Controllers\TurmaMethodsController;

Route::middleware('administrador')->group(function () {

		// Deshboard Admin
		Route::get('adm', [AdminController::class, 'index'])->name('adm.index');

		// Users routes
		Route::get('/register', [UserController::class, 'create'])->name('users.register.view');
		Route::post('/register', [UserController::class, 'store'])->name('users.register');
		Route::get('/users', [UserController::class, 'show'])->name('users');
		Route::get('/users/edit/{id}', [UserController::class, 'edit'])->name('users.edit.view');
		Route::put('/users/update/{id}', [UserController::class, 'update'])->name('users.update');
		Route::get('/users/remove/{id}', [UserController::class, 'remove'])->name('users.remove');
		Route::get('/users/search', [UserController::class, 'searchName'])->name('users.search.view');
		Route::post('/users/search', [UserController::class, 'search'])->name('users.search');

		// Requeriments routes
		Route::get('/requerimentos', [RequerimentosController::class, 'show'])->name('requerimentos');
		Route::get('requerimmentos/search', [RequerimentosController::class, 'search'])->name('requerimentos.search');
		Route::get('/requerimentos/edit/{id}', [RequerimentosController::class, 'edit'])->name('requerimentos.update.view');
		Route::put('/requerimentos/update/{id}', [RequerimentosController::class, 'update'])->name('requerimentos.update');
		Route::get('/requerimentos/remove/{id}', [RequerimentosController::class, 'remove'])->name('requerimentos.remove');

		// Cursos routes
		Route::get('/cursos', [CursosController::class, 'show'])->name('cursos');
		Route::get('/cursos/create', [CursosController::class, 'index'])->name('cursos.create.view');
		Route::post('/cursos/create', [CursosController::class, 'create'])->name('cursos.create');
		Route::get('/cursos/remove/{id}', [CursosController::class, 'remove'])->name('cursos.remove');
		Route::get('/cursos/edit/{id}', [CursosController::class, 'edit'])->name('cursos.edit.view');
		Route::put('/cursos/update/{id}', [CursosController::class, 'update'])->name('cursos.update');

		// Disciplinas routes
		Route::get('/disciplinas', [DisciplinasController::class, 'show'])->name('disciplinas');
		Route::get('/disciplinas/create', [DisciplinasController::class, 'index'])->name('disciplinas.create.view');
		Route::post('/disciplinas/create', [DisciplinasController::class, 'create'])->name('disciplinas.create');
		Route::get('/disciplinas/remove/{id}', [DisciplinasController::class, 'remove'])->name('disciplinas.remove');
		Route::get('/disciplinas/edit/{id}', [DisciplinasController::class, 'edit'])->name('disciplinas.edit.view'); // Concluir rota
		Route::put('/disciplinas/update/{id}', [DisciplinasController::class, 'update'])->name('disciplinas.update'); // Concluir rota

		// Turmas routes
		Route::get('/turmas', [TurmaController::class, 'show'])->name('turmas');
		Route::get('/turmas/create', [TurmaController::class, 'index'])->name('turmas.create.view');
		Route::post('/turmas/create', [TurmaController::class, 'create'])->name('turmas.create');
		Route::get('/turmas/edit/{id}', [TurmaController::class, 'edit'])->name('turmas.edit.view');
		Route::put('/turmas/update/{id}', [TurmaController::class, 'update'])->name('turmas.edit.update');
		Route::get('/turmas/remove/{id}', [TurmaController::class, 'remove'])->name('turmas.remove');
		Route::get('/turmas/alunos/cadastrados/{id}', [BoletimController::class, 'index'])->name('turmas.alunos.all');
		Route::get('/turma/alunos/{id}', [TurmaMethodsController::class, 'alunos'])->name('turmas.alunos.all');
		Route::post('/turma/alunos/{id}', [TurmaMethodsController::class, 'addAlunos'])->name('turmas.alunos.register');

		// Boletim routes
		Route::get('/turmas/alunos/{id}', [BoletimController::class, 'index'])->name('turmas.alunos.view');
	});

?>
