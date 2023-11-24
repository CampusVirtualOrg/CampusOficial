<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LogonController;
use App\Http\Controllers\RequerimentosController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccessibleController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AlunoController;
use App\Http\Controllers\AvisosController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CursosController;
use App\Http\Controllers\DisciplinasController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfessorController;
use App\Http\Controllers\TurmaController;
use App\Http\Middleware\Professor;

/*
|--------------------------------------------------------------------------
| WEB ROUTES
|--------------------------------------------------------------------------
*/

Route::get('/', [AccessibleController::class, 'index'])->name('welcome');

Route::get('/turma/create',[TurmaController::class,'createIndex'])->name('registerTurmas');

Route::middleware('auth')->group(function () {

	Route::get('/logon', [LogonController::class, 'create']); // Redireciona conforme tipo de Usuário

	// ----------------------- ProfileController ---------------------------//
	Route::controller(ProfileController::class)->group(function () {
		Route::get('/profile',  'edit')->name('profile.edit');
		Route::patch('/profile',  'update')->name('profile.update');
		Route::delete('/profile',  'destroy')->name('profile.destroy');
	});

	// ----------------------- AVISOS ---------------------------//
	Route::controller(PostController::class)->group(function () {
		Route::get('/aviso', 'index')->name('aviso.show.all');
		Route::get('/aviso/{id}', 'showOne')->name('aviso.show.one');
		Route::get('/aviso/create/view', 'create')->name('aviso.create.view');
		Route::post('/aviso/create', 'store')->name('aviso.create');
		Route::get('/aviso/editar/{id}', 'edit')->name('aviso.edit.view');
		Route::post('/aviso/update/{id}', 'update')->name('aviso.update');
		Route::get('/aviso/remove/{id}', 'remove')->name('aviso.remove');
	});

	// ----------------------- COMMENT CONTROLLER ---------------------------//
	Route::controller(CommentController::class)->group(function () {
		Route::post('/aviso/comment', 'store')->name('comment.store');
		Route::delete('/aviso/comment/r/{id}', 'remove')->name('comment.remove');


		// ----------------------- REQUERIMENTOS ---------------------------//
		Route::controller(RequerimentosController::class)->group(function () {
			Route::get('/requerimento',  'createIndex');
			Route::post('/enviarRequerimento',  'create')->name('enviarRequerimento');
		});




		//-------------- ROTAS DO ADMINISTRADOR ---------------//

		Route::middleware('administrador')->group(function () {
			Route::controller(RegisteredUserController::class)->group(function () {
				Route::get('/register', 'create')->name('register');
				Route::post('/register', 'store');
			});

			Route::controller(AdminController::class)->group(function () {
				Route::get('/adm', 'home')->name('admin.home');
				Route::get('/usuarios', 'users')->name('usuarios');
				Route::get('/usuarios/edit/{id}', 'indexUpdate');
				Route::put('/usuarios/update/{id}', 'edit');
				Route::get('/usuarios/remove/{id}', 'remove');
			});

			// REQUERIMENTOS
			Route::controller(RequerimentosController::class)->group(function () {
				Route::get('/dashboardRequerimentos', 'create')->name('dashboardRequerimentos');
				Route::get('/requerimentos', 'showAll')->name("requerimentos");
				Route::post('/requerimentos', 'search');
				Route::get('/requerimentos/edit/{id}', 'updateIndex');
				Route::post('/requerimentos/edit/{id}', 'update');
				Route::get('/requerimentos/remove/{id}', 'remove');
			});

			// CURSOS
			Route::controller(CursosController::class)->group(function() {
				Route::get('/cursos','showAll')->name('cursos');
				Route::get('/cursos/remove/{id}', 'remove');
			});

			// DISCIPLINAS
			Route::controller(DisciplinasController::class)->group(function() {
				Route::get('/disciplinas','showAll')->name('disciplinas');
				Route::get('/disciplinas/remove/{id}', 'remove');
				Route::get('/disciplinas/create', 'createIndex')->name('createDisciplinas');
				Route::post('/disciplinas/create', 'create');
			});

			// TURMAS
			Route::controller(TurmaController::class)->group(function() {
				Route::get('/turmas','showAll')->name('turmas');
				// Route::get('/turma/create','createIndex')->name('registerTurmas');
				Route::post('/turma/create','create');
				Route::get('/turmas/remove/{id}', 'remove');
			});
		});


		//------------------ ROTAS DO ALUNO --------------------//

		Route::middleware('aluno')->group(function () {
			Route::controller(AlunoController::class)->group(function () {
				Route::get('/aluno', 'index')->name('homeAluno');
				Route::get('/boletim', 'boletim')->name('boletim');
				Route::get('/minhasdisciplinas', 'disciplinas')->name('disciplinasAluno');
			});
		});


		//---------------- ROTAS DO PROFESSOR ------------------//

		Route::middleware('professor')->group(function () {
			Route::controller(ProfessorController::class)->group(function () {
				Route::get('/professor', 'index')->name('homeProfessor');
			});
		});


		// Route::middleware(['administrador', 'professor'])->group(function () {
		// 	Route::get('/turmas', [TurmaController::class, 'showAll'])->name('turmas');
		// 	Route::get('/disciplinas', [DisciplinasController::class, 'showAll'])->name('disciplinas');
		// 	Route::get('/cursos', [CursosController::class, 'showAll'])->name('cursos');
		// });
	});
});




require __DIR__ . '/auth.php';
