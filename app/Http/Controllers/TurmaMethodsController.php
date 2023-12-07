<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Turma;
use App\Models\User;
use App\Models\Usuario_turmas;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;
use App\Models\Disciplina;
use App\Models\Curso;

class TurmaMethodsController extends Controller
{
	public function alunos(string $id)
	{
		$user = Auth::user();
		$turma = Turma::where('id', $id)->first();
		$disciplina = Disciplina::where('id', $turma->disciplina_id)->first();
		$curso = Curso::all()->where('id', $disciplina->curso_id);

		$alunos = DB::table('users')
        ->whereNotIn('id', function ($query) use ($id) {
            $query->select('aluno_id')	// Essa subconsulta retorna os alunos matriculados 
                ->from('usuario_turmas') // nesse $id da turma fornecido, porem o whereNotIn
                ->where('turma_id', $id); // , por final retorna o contrario da subconsulta (;
        })
        ->where('curso_id', '=', $disciplina->curso_id)
        ->get();

		return Inertia::render('Adm/Turmas/Alunos', ['alunos' => $alunos, 'user' => $user, 'turma' =>  $turma, 'curso' => $curso]);
	}


	public function addAlunos(Request $request, string $id)
	{
		$credentials = $request->only('aluno_id');
		$register = new Usuario_turmas([
			'aluno_id' => $credentials['aluno_id'],
			'turma_id' => $id,
			'nota_unidade1' => null,
			'nota_unidade2' => null,
			'media_final' => null,
		]);

		$register->save();
		return redirect('/turmas');
	}

	public function professor()
	{
		$user = Auth::user();
		$turmas = Turma::where('professor_id', $user->id)->get();
		return Inertia::render('Professor/Turmas/Turmas', ['turmas' => $turmas, 'user' => $user]);
	}
}
