<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LogonController;
use App\Http\Controllers\RequerimentosController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccessibleController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AlunoController;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CursosController;
use App\Http\Controllers\DisciplinasController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfessorController;
use App\Http\Controllers\TurmaController;
use App\Http\Controllers\TurmaMethodsController;
use App\Http\Controllers\BoletimController;



/*
|--------------------------------------------------------------------------
| WEB ROUTES CAMPUS VIRTUAL
|--------------------------------------------------------------------------
*/

Route::get('/', [AccessibleController::class, 'index'])->name('welcome');

Route::middleware('auth')->group(function () {

	// Logon routes
	Route::get('/logon', [LogonController::class, 'create']);

	// Profile routes
	Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
	Route::patch('/profile',[ProfileController::class, 'update'])->name('profile.update');
	Route::delete('/profile',[ProfileController::class, 'destroy'])->name('profile.destroy');

	// reports routes
	Route::get('/aviso', [PostController::class, 'index'])->name('avisos');
	Route::get('/aviso/{id}', [PostController::class, 'show'])->name('avisos.show');
	Route::get('/aviso/create/view', [PostController::class, 'create'])->name('avisos.create.view');
	Route::post('/aviso/create', [PostController::class, 'store'])->name('avisos.create');
	Route::get('/aviso/editar/{id}', [PostController::class, 'edit'])->name('avisos.edit.view');
	Route::post('/aviso/update/{id}', [PostController::class, 'update'])->name('avisos.update');
	Route::get('/aviso/remove/{id}', [PostController::class, 'remove'])->name('avisos.remove');

	// Comments routes
	Route::post('aviso/comment', [CommentController::class, 'store'])->name('comments.store');
	Route::delete('aviso/comment/id}', [CommentController::class, 'destroy'])->name('comments.remove');

	// Create requeriments routes
	Route::get('/requerimento/create', [RequerimentosController::class, 'index'])->name('requerimento.index');
	Route::post('/requerimento/create', [RequerimentosController::class, 'store'])->name('requerimento.store');
});

Route::middleware(['auth','administrador'])->group(function () {

	// Deshboard Admin
	Route::get('adm', [AdminController::class, 'index'])->name('adm.index');

	// Users routes
	Route::get('/register', [UserController::class, 'create'])->name('users.register.view');
	Route::post('/register', [UserController::class, 'store'])->name('users.register');
	Route::get('/users', [UserController::class, 'show'])->name('users.show');
	Route::get('/users/edit/{id}', [UserController::class, 'edit'])->name('users.edit.view');
	Route::put('/users/update/{id}', [UserController::class, 'update'])->name('users.update');
	Route::get('/users/remove/{id}', [UserController::class, 'remove'])->name('users.remove');
	Route::get('/users/search', [UserController::class, 'searchName'])->name('users.search.view');
	Route::post('/users/search', [UserController::class, 'search'])->name('users.search');

	// Requeriments routes
	Route::get('/requerimentos', [RequerimentosController::class, 'show'])->name('requerimentos.show');
	Route::get('requerimmentos/search', [RequerimentosController::class, 'search'])->name('requerimentos.search');
	Route::get('/requerimentos/edit/{id}', [RequerimentosController::class, 'edit'])->name('requerimentos.update.view');
	Route::post('/requerimentos/edit/{id}', [RequerimentosController::class, 'update'])->name('requerimentos.update');
	Route::get('/requerimentos/remove/{id}', [RequerimentosController::class, 'remove'])->name('requerimentos.remove');

	// Cursos routes
	Route::get('/cursos', [CursosController::class, 'show'])->name('cursos');
	Route::get('/cursos/create', [CursosController::class, 'index'])->name('cursos.create.view');
	Route::get('/cursos/remove/{id}', [CursosController::class, 'remove'])->name('cursos.remove');
	Route::get('/cursos/edit/{id}', [CursosController::class, 'edit'])->name('cursos.edit.view');
	Route::put('/cursos/update/{id}', [CursosController::class, 'update'])->name('cursos.update');

	// Disciplinas routes
	Route::get('/disciplinas', [DisciplinasController::class, 'show'])->name('disciplinas.show');
	Route::get('/disciplinas/create', [DisciplinasController::class, 'index'])->name('disciplinas.create.view');
	Route::post('/disciplinas/create', [DisciplinasController::class, 'create'])->name('disciplinas.create');
	Route::get('/disciplinas/remove/{id}', [DisciplinasController::class, 'remove'])->name('disciplinas.remove');

	// Turmas routes
	Route::get('/turmas', [TurmaController::class, 'show'])->name('turmas.show');
	Route::get('/turmas/create', [TurmaController::class, 'index'])->name('turmas.create.view');
	Route::post('/turmas/create', [TurmaController::class, 'create'])->name('turmas.create');
	Route::get('/turmas/remove/{id}', [TurmaController::class, 'remove'])->name('turmas.remove');
	Route::get('/turmas/alunos/{id}', [TurmaMethodsController::class, 'alunos'])->name('turmas.alunos');
	Route::post('/turmas/alunos/{id}', [TurmaMethodsController::class, 'addAlunos'])->name('turmas.alunos.add');

	// Boletim routes
	Route::get('/turmas/alunos/{id}', [BoletimController::class, 'index'])->name('turmas.alunos.view');
});

Route::middleware(['auth','aluno'])->group(function () {

	// Alunos routes
	Route::get('/aluno', [AlunoController::class, 'index'])->name('aluno.index');
	Route::get('/boletim', [AlunoController::class, 'boletim'])->name('aluno.boletim');
	Route::get('/minhasdisciplinas', [AlunoController::class, 'disciplinas'])->name('aluno.disciplinas');
});

Route::middleware(['auth','professor'])->group(function () {

	// Dashboard professor
	Route::get('/professor', [ProfessorController::class, 'index'])->name('professor.index');

	// Turmas routes
	Route::get('/professor/turmas', [TurmaMethodsController::class, 'index'])->name('professor.turma');

	// Boletim routes
	Route::get('/professor/turmas/{id}', [ProfessorController::class, 'boletim'])->name('professor.boletim.view');
	Route::get('/professor/turmas/editar/{id}', [ProfessorController::class, 'boletimAluno'])->name('professor.boletim.aluno');
	Route::post('/professor/turmas/editar/{id}', [BoletimController::class, 'update'])->name('professor.turma.boletim');
});

require __DIR__ . '/auth.php';

