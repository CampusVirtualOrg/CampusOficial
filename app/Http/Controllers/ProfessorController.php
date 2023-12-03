<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use App\Models\Turma;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class ProfessorController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return Inertia::render('Professor/DashboardProf', ['user' => $user]);
    }

	public function boletim( String $id)
	{
		$user = Auth::user();
		$turma = Turma::where('id', $id)->with(['disciplina', 'professor'])->first();
		$alunos = DB::table('usuario_turmas')
			->join('users', 'users.id', '=', 'usuario_turmas.aluno_id')
			->select('users.*', 'usuario_turmas.faltas', 'usuario_turmas.nota_unidade1', 'usuario_turmas.nota_unidade2', 'usuario_turmas.media_final')
			->get();

		return Inertia::render('Professor/Turmas/Boletim', ['turma' => $turma, 'user' => $user, 'alunos' => $alunos]);
	}

	public function boletimAluno(Request $request ,String $id)
	{
		$turma_id = $request->only('turma_id');
		$alunos = User::all()->where('id',$id);
		return Inertia::render('Professor/Turmas/BoletimAluno', ["turma" => $turma_id, 'user' => $id ,'alunos' => $alunos]);
	}

}
