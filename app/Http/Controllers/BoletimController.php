<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Turma;
use App\Models\Usuario_turmas;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Inertia\Inertia;

class BoletimController extends Controller
{
	public function index(String $id)
	{
		$user = Auth::user();
		$turma = Turma::where('id', $id)->with(['professor', 'disciplina'])->first();
		$boletimAluno = DB::table('usuario_turmas')
			->join('users', 'users.id', '=', 'usuario_turmas.aluno_id')
			->where('usuario_turmas.turma_id', '=', $id)
			->join('turmas', 'turmas.id', '=', 'usuario_turmas.turma_id')
			->select('users.*', 'usuario_turmas.faltas', 'usuario_turmas.nota_unidade1', 'usuario_turmas.nota_unidade2', 'usuario_turmas.media_final')
			->get();
		return Inertia::render('Adm/Turmas/VerAlunos', ['alunos' => $boletimAluno, 'user' => $user, 'turma' =>  $turma]);
	}

	public function boletim(String $id)
	{
		$user = Auth::user();
		$turma = Turma::where('id', $id)->with(['disciplina', 'professor'])->first();
		$alunos = DB::table('usuario_turmas')
			->join('users', 'users.id', '=', 'usuario_turmas.aluno_id')
			->select('users.*', 'usuario_turmas.faltas', 'usuario_turmas.nota_unidade1', 'usuario_turmas.nota_unidade2', 'usuario_turmas.media_final')
			->get();

		return Inertia::render('Professor/Turmas/Boletim', ['turma' => $turma, 'user' => $user, 'alunos' => $alunos]);
	}

	public function boletimAluno(Request $request, String $id)
	{	
		$user = Auth::user();
		$turma_id = $request->only('turma_id');
		$turmaObject = Turma::where('id', $turma_id)->with(['professor', 'disciplina'])->first();
		$alunos = User::all()->where('id', $id);
		$userCurrrent = User::where('id', $id)->first();
		return Inertia::render('Professor/Turmas/BoletimAluno', ['userCurrent' => $userCurrrent,"authUser" => $user ,"turma" => $turma_id, 'userId' => $id, 'alunos' => $alunos, 'turmaObject' => $turmaObject]);
	}

	public function update(Request $request, String $id)
	{
		$credentials = $request->only('faltas', 'nu1', 'nu2', 'turma_id');
		$turma_id = $credentials['turma_id'];
		$subject = Usuario_turmas::where('turma_id', $credentials['turma_id'])->where('aluno_id', $id)->first();
		$subject->update(
			[
				'aluno_id' => $id,
				'turma_id' => $turma_id,
				'nota_unidade1' => $credentials['nu1'],
				'nota_unidade2' => $credentials['nu2'],
				'faltas' => $credentials['faltas'],
				'media_final' => ($credentials['nu1'] + $credentials['nu2']) / 2,
			]
		);

		return redirect("/professor/turmas/$turma_id");
	}
}
