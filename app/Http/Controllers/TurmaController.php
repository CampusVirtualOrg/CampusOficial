<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Disciplina;
use App\Models\Disciplina_turmas;
use Illuminate\Http\Request;
use App\Models\Turma;
use App\Models\Usuario;
use App\Models\Aluno_turma;
use App\Models\User;
use App\Models\Usuario_turmas;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use PhpParser\Node\Expr\Cast\String_;

use function Psy\debug;

class TurmaController extends Controller
{
    public function showAll()
    {
        $turmas = Turma::with(['disciplina', 'professor'])->get();
        $professores = User::where('tipo', 'Professor')->get();
        $user = Auth::user();
        return Inertia::render('Adm/Turmas/Turmas', ['turmas' => $turmas, 'professores' => $professores, 'user' => $user]);
    }

    public function createIndex()
    {

        $user = Auth::user();
        $disciplinas = Disciplina::all();
        $professores = User::where('tipo', 'Professor')->get();

        return Inertia::render('Adm/Turmas/CreateTurmas', ['disciplinas' => $disciplinas, 'professores' => $professores, 'user' => $user]);
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
                    'professor_id' => $credentials['professor_id'],
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

    public function addDisc(string $id)
    {

        $disciplinas = Disciplina::all();

        return view('adm.turmas.createTurmasDisc', ['disciplinas' => $disciplinas, 'turmas_id' => $id]);
    }

    public function addDiscCreate(Request $request)
    {
        $credentials = $request->only('disciplina_id', 'turmas_id');

        $resp = new Disciplina_turmas([
            'disciplina_id' => $credentials['disciplina_id'],
            'turmas_id' => $credentials['turmas_id'],

        ]);
        $resp->save();
        return redirect('/turmas');
    }

    public function showOne(String $id)
    {

        try {

            if ($id == null) {
                echo 'vazioo';
            }


            $disciplinas = DB::table('disciplina_turmas')
                ->join('turmas', 'disciplina_turmas.turmas_id', '=', 'turmas.id')
                ->select('disciplina_turmas.disciplina_id')
                ->where('turmas_id', '=', $id) // Substitua 1 pelo ID da turma desejada
                ->get();


            $ids = [];
            $tamanho = count($disciplinas);
            for ($i = 0; $i < $tamanho; $i++) {
                array_push($ids, $disciplinas[$i]->disciplina_id);
            }

            $turmas = DB::table('disciplinas')
                ->whereIn('id', $ids)
                ->get();

            $usersIds = Usuario_turmas::where('turma_id', $id)->pluck('aluno_id')->all();
            $alunos = User::whereIn('id', $usersIds)->select('nome')->get();

            return view('adm.turmas.turmaone', ['disciplinas' => $turmas, 'alunos' => $alunos]);
        } catch (\Throwable $th) {
            echo 'erro';
        }
    }

    public function updateIndex(string $id)
    {
        $disciplinas = Disciplina::all();
        $professores = User::where('tipo', '=', 2)->get();
        $turmas = Turma::all()->where('id', $id)->first();
        return view('adm.turmas.editTurmas', ['turmas' => $turmas, 'disciplinas' => $disciplinas, 'professores' => $professores]);
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
        //VERIFICA SE ID EXISTE
        $course = Turma::all()->where('id', $id)->first();
        if (!$course) {
            return response([
                'msg' => 'turma não removida',
                'data' => $course
            ]);
        }
        //REMOVE User
        $course->delete();
        return redirect('/turmas');
    }

    public function alunoIndex(String $id)
    {
        $turma = Turma::where('id', $id)->first();
        $alunos = User::where('tipo', 'Aluno')->get();
        return view('adm.turmas.addAluno', ['turma' => $turma, 'alunos' => $alunos]);
    }

    public function addAluno(Request $request)
    {
        $credentials = $request->only('aluno_id', 'turma_id');

        $register = new Usuario_turmas([
            'aluno_id' => $credentials['aluno_id'],
            'turma_id' => $credentials['turma_id']
        ]);

        $register->save();

        return redirect('/turmas');
    }
    public function search(Request $request)
    {
        $turmas = Turma::where('nome', 'LIKE', '%' . $request->text . '%')
            ->orWhere('semestre', 'LIKE', '%' . $request->text . '%')
            ->orWhere('turno', 'LIKE', '%' . $request->text . '%')
            ->paginate(10);
        $professores = User::all();
        return view('adm.turmas.turmas', ['turmas' => $turmas, 'professores' => $professores]);
    }

    public function turmaProfessor()
    {
        $user = Auth::user();
        $turmas = Turma::where('professor_id', $user->id)->get();
        return Inertia::render('Professor/Turmas/Turmas', ['turmas' => $turmas, 'user' => $user]);
    }

    public function turmaProfessorIndex(String $id)
    {
        $user = Auth::user();
        $turma = Turma::where('id', $id)->with(['disciplina', 'professor'])->first();
        $alunos = DB::table('usuario_turmas')
            ->join('users', 'users.id', '=', 'usuario_turmas.aluno_id')
            ->select('users.*', 'usuario_turmas.faltas', 'usuario_turmas.nota_unidade1', 'usuario_turmas.nota_unidade2', 'usuario_turmas.media_final')
            ->get();
        return Inertia::render('Professor/Turmas/TurmaIndex', ['turma' => $turma, 'user' => $user, 'alunos' => $alunos]);
    }

    public function atualizarBoletim(Request $request)
    {
        // Processar os dados do formulário
        foreach ($request->alunos as $aluno) {
            // Atualizar os dados do boletim do aluno
            DB::table('usuario_turmas')
                ->where('id', $aluno['id'])
                ->update([
                    'faltas' => $aluno['faltas'],
                    'nota_unidade1' => $aluno['nota_unidade1'],
                    'nota_unidade2' => $aluno['nota_unidade2'],
                    'media_final' => $aluno['media_final'],
                ]);
        }

        return redirect('/turmas'); // Redirecionar após a atualização
    }


    public function alunos(string $id)
    {
        $user = Auth::user();
        $turma = Turma::where('id', $id)->first();
        $disciplina = Disciplina::where('id', $turma->disciplina_id)->first();
        $alunos = User::where('tipo', 'Aluno');
        $alunosHabilitados = $alunos->where('curso_id', $disciplina->curso_id)->with('curso')->get();
        // $usuariosId = $alunos->pluck('aluno_id');
        // $alunosEncontrados = User::whereIn('id', $usuariosId)->select('name', 'id')->get();


        return Inertia::render('Adm/Turmas/Alunos', ['alunos' => $alunosHabilitados, 'user' => $user, 'turma' =>  $turma]);
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

    public function turmaAlunos(String $id)
    {
        $user = Auth::user();
        $turma = Turma::where('id', $id)->with(['professor', 'disciplina'])->first();
        $boletimAluno = DB::table('usuario_turmas')
            ->join('users', 'users.id', '=', 'usuario_turmas.aluno_id')
            ->join('turmas', 'turmas.id', '=', 'usuario_turmas.turma_id')
            ->select('users.*', 'usuario_turmas.faltas', 'usuario_turmas.nota_unidade1', 'usuario_turmas.nota_unidade2', 'usuario_turmas.media_final')
            ->get();
        return Inertia::render('Adm/Turmas/VerAlunos', ['alunos' => $boletimAluno, 'user' => $user, 'turma' =>  $turma]);
    }
}
