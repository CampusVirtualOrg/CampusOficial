<?php

namespace App\Http\Controllers;

use App\Models\Disciplina;
use Illuminate\Http\Request;
use App\Models\Turma;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use App\Models\Disciplina_turmas;

class TurmaController extends Controller
{

	public function index()
	{
		$user = Auth::user();
		$disciplinas = Disciplina::all();
		$professores = User::where('tipo', 'Professor')->get();

		return Inertia::render('Adm/Turmas/CreateTurmas', ['disciplinas' => $disciplinas, 'professores' => $professores, 'user' => $user]);
	}

	public function show()
	{
		$turmas = Turma::with(['disciplina', 'professor'])->get();
		$professores = User::where('tipo', 'Professor')->get();
		$user = Auth::user();
		return Inertia::render('Adm/Turmas/Turmas', ['turmas' => $turmas, 'professores' => $professores, 'user' => $user]);
	}

	public function create(Request $request)
	{
		try {
			$credentials = $request->only('semestre', 'turno', 'disciplina_id', 'horario', 'professor_id');

			if ($credentials['semestre'] == null || $credentials['turno'] == null) {
				echo 'Dados incompletos!';
			}

			$disciplina = Disciplina::where('id', $credentials['disciplina_id'])->first();
			if ($disciplina) {
				$siglaDisciplina = $disciplina->sigla;
				$nomeBase = "{$siglaDisciplina}.{$credentials['semestre']}.{$credentials['turno']}";
				$count = Turma::where('nome', 'like', "$nomeBase%")->count();
				$nome = $count > 0 ? "$nomeBase-$count" : $nomeBase;

				$turma = new Turma([
					'nome' => "$nome",
					'semestre' => $credentials['semestre'],
					'turno' => $credentials['turno'],
					'horario' => $credentials['horario'],
					'disciplina_id' => $credentials['disciplina_id'],
					'professor_id' => $credentials['professor_id']
				]);

				$turma->save();

				return redirect('/turmas');
			} else {
				return response()->json(
					[
						'success' => false,
						'data' => "Disciplina não encontrada",
					],
					301
				);
			}
		} catch (\Throwable $th) {
			echo 'Ops!  ' . $th->getMessage();
		}
	}

	public function update(Request $request, string $id)
	{
		try {
			if (Turma::where('id', $id)->exists()) {
				$turma = [
					'nome' => $request->nome,
					'semestre' => $request->semestre,
					'turno' => $request->turno,

					'professor_id' => $request->professor_id,
				];

				Turma::where('id', $id)->update($turma);
				return redirect('/turmas');
			} else {
				return response()->json([
					"success" => false
				], 404);
			}
		} catch (\Throwable $e) {
			return response()->json([
				"success" => false,
				"error" => $e->getMessage()
			], 400);
		}
	}

	public function remove(string $id)
	{
		$course = Turma::all()->where('id', $id)->first();
		if (!$course) {
			return response([
				'msg' => 'turma não removida',
				'data' => $course
			]);
		}

		$course->delete();
		return redirect('/turmas');
	}

	// public function search(Request $request)
	// {
	// 	$turmas = Turma::where('nome', 'LIKE', '%' . $request->text . '%')
	// 		->orWhere('semestre', 'LIKE', '%' . $request->text . '%')
	// 		->orWhere('turno', 'LIKE', '%' . $request->text . '%')
	// 		->paginate(10);
	// 	$professores = User::all();
	// 	return view('adm.turmas.turmas', ['turmas' => $turmas, 'professores' => $professores]);
	// }

	// public function edit(string $id)
	// {
	// 	$disciplinas = Disciplina::all();
	// 	$professores = User::where('tipo', '=', 2)->get();
	// 	$turmas = Turma::all()->where('id', $id)->first();
	// 	return view('adm.turmas.editTurmas', ['turmas' => $turmas, 'disciplinas' => $disciplinas, 'professores' => $professores]);
	// }


	// public function showOne(String $id)
	// {

	// 	try {

	// 		if ($id == null) {
	// 			echo 'vazioo';
	// 		}


	// 		$disciplinas = DB::table('disciplina_turmas')
	// 			->join('turmas', 'disciplina_turmas.turmas_id', '=', 'turmas.id')
	// 			->select('disciplina_turmas.disciplina_id')
	// 			->where('turmas_id', '=', $id)
	// 			->get();


	// 		$ids = [];
	// 		$tamanho = count($disciplinas);
	// 		for ($i = 0; $i < $tamanho; $i++) {
	// 			array_push($ids, $disciplinas[$i]->disciplina_id);
	// 		}

	// 		$turmas = DB::table('disciplinas')
	// 			->whereIn('id', $ids)
	// 			->get();

	// 		$usersIds = Usuario_turmas::where('turma_id', $id)->pluck('aluno_id')->all();
	// 		$alunos = User::whereIn('id', $usersIds)->select('nome')->get();

	// 		return view('adm.turmas.turmaone', ['disciplinas' => $turmas, 'alunos' => $alunos]);
	// 	} catch (\Throwable $th) {
	// 		echo 'erro';
	// 	}
	// }
}
