<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Turma;
use App\Models\Usuario_turmas;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class BoletimController extends Controller
{
    public function index(String $id)
	{
		$user = Auth::user();
		$turma = Turma::where('id', $id)->with(['professor', 'disciplina'])->first();
		$boletimAluno = DB::table('usuario_turmas')
			->join('users', 'users.id', '=', 'usuario_turmas.aluno_id')
			->where('usuario_turmas.turma_id', '=', $id) // Adiciona a condição para o curso desejado
			->join('turmas', 'turmas.id', '=', 'usuario_turmas.turma_id')
			->select('users.*', 'usuario_turmas.faltas', 'usuario_turmas.nota_unidade1', 'usuario_turmas.nota_unidade2', 'usuario_turmas.media_final')
			->get();
		return Inertia::render('Adm/Turmas/VerAlunos', ['alunos' => $boletimAluno, 'user' => $user, 'turma' =>  $turma]);
	}

	public function update(Request $request ,String $id)
	{
		$credentials = $request->only('faltas','nu1','nu2','turma_id');

			$update =  Usuario_turmas::all()->where('id',$credentials['turma_id']);
			$update->update([
				'aluno_id' => $id,
				'turma_id' => $credentials['turma_id'],
				'nota_unidade1' => $credentials['nu1'],
				'nota_unidade2' => $credentials['nu2'],
				'faltas' => $credentials['faltas'],
				'media_final' => ($credentials['nu1']+$credentials['nu2'])/2,]
			);

		return redirect('/professor/turmas');
	}
}
