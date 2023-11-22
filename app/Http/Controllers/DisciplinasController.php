<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Disciplina;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class DisciplinasController extends Controller
{
    public function showAll()
    {
        $disciplinas = Disciplina::all();
        $user = Auth::user();
        return Inertia::render('Adm/Disciplinas/Disciplinas', ['disciplinas' => $disciplinas, 'user' => $user]);
    }

    public function create(Request $request){

        try {
            $credentials = $request->only('nome','carga_horaria');

            //VALIDA DADOS
            if(($credentials['nome'] == null ||
                $credentials['carga_horaria'] == null
            ))
            {
                return response()->json([
                    'success' => false,
                    'msg' => $credentials['carga_horaria'],
                ],
                301);
            }

            //MODELO RECEBE OS DADOS PARA SEREM
            $subject = new Disciplina([
                'nome' => $credentials['nome'],
                'sigla' => $credentials['sigla'],
                'carga_horaria' => $credentials['carga_horaria'],
                'pre_requisito_id' => $credentials['pre_requisito_id'],
                'curso_id' => $credentials['curso_id'],
            ]);
            $subject->save();

            //RETORNA A RESPOSTA
            return redirect('/disciplinas');

        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'error' => $th->getMessage()],400);
        }

    }

    public function updateIndex(String $id){
        $disciplina = Disciplina::all()->where('id',$id)->first();
        return view('adm.disciplinas.editDisciplina', ['disc' => $disciplina]);
    }

    public function update(Request $request, String $id){
        try {
            $credentials = $request->only('nome', 'carga_horaria');

            if (Disciplina::where('id', $id)->exists()) {
                $Disciplina = [
                    'nome' => $request->nome,
                    'carga_horaria' => $request->carga_horaria,
                ];

                Disciplina::where('id', $id)->update($Disciplina);
                return redirect('/disciplinas');
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
        $subject = Disciplina::all()->where('id',$id)->first();

        //REMOVE User
        $subject->delete();
        return redirect('/disciplinas');

    }

    public function search(Request $request)
    {
        $subject = Disciplina::where('nome', 'LIKE', '%' . $request->text . '%')
        ->orWhere('carga_horaria', 'LIKE', '%' . $request->text . '%')
        ->paginate(10);
        return view('adm.disciplinas.disciplinas', ['disc' => $subject]);
    }

}
