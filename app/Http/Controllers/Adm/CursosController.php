<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Curso;
use App\Models\Disciplina;
use App\Models\Curso_disciplina;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class CursosController extends Controller
{
	public function index()
    {
        return view('adm.cursos.createCursos');
    }

    public function show()
    {
        $cursos = Curso::all();
        $user = Auth::user();
        return Inertia::render('Adm/Cursos/Cursos', ['cursos' => $cursos, 'user' => $user]);
    }

    public function create(Request $request)
    {

        try {
            $credentials = $request->only('nome', 'carga_horaria', 'periodos', 'sigla');

            if (($credentials['nome'] == null ||
                $credentials['carga_horaria'] == null)) {
                return response()->json(
                    [
                        'msg' => 'dados incompletos!',
                    ],
                    301
                );
            }
            //MODELO RECEBE OS DADOS PARA SEREM
            $course = new Curso([
                'nome' => $credentials['nome'],
                'carga_horaria' => $credentials['carga_horaria'],
                'periodos' => $credentials['periodos'],
                'sigla' => $credentials['sigla'],
                'categoria' => $credentials['categoria'],
                'descricao' => $credentials['descricao'],
            ]);
            $course->save();

            //RETORNA A RESPOSTA
            return redirect('/cursos');
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'error' => $th->getMessage()], 302);
        }
    }

    public function edit(string $id)
    {
        $user = Auth::user();
        $curso = Curso::all()->where('id', $id)->first();
        return Inertia::render('Adm/Cursos/EditCursos', ['curso' => $curso, 'user' => $user]);
    }

    public function update(Request $request, string $id)
    {
        try {
            if (Curso::where('id', $id)->exists()) {
                $Curso = [
                    'nome' => $request->nome,
                    'carga_horaria' => $request->carga_horaria,
                    'periodos' => $request->periodos,
                    'sigla' => $request->sigla,
                    'categoria' => $request->categoria,
                    'descricao' => $request->descricao,
                ];

                Curso::where('id', $id)->update($Curso);
                return redirect('/cursos');
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
        //VERIFICA SE ID EXISTE
        $course = Curso::all()->where('id', $id)->first();
        if (!$course) {
            return response([
                'msg' => 'Curso não removido',
                'data' => $course
            ]);
        }
        //REMOVE User
        $course->delete();
        return redirect('/cursos');
    }

    public function search(Request $request)
    {
        $course = Curso::where('nome', 'LIKE', '%' . $request->text . '%')
            ->orWhere('carga_horaria', 'LIKE', '%' . $request->text . '%')
            ->orWhere('sigla', 'LIKE', '%' . $request->text . '%')
            ->paginate(10);
        return view('adm.cursos.cursos', ['course' => $course]);
    }

	public function disciplinas(String $courseId)
    {
        $disciplinas = Curso_disciplina::where('curso_id', $courseId)->get();
        $disciplinaIds = $disciplinas->pluck('disciplina_id');

        $disciplinasEncontradas = Disciplina::whereIn('id', $disciplinaIds)->select('nome')->get();

        return redirect('/cursos', ['disciplinas' => $disciplinasEncontradas]);
    }

}
