<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Query\Builder;
use App\Models\Disciplina;
use App\Models\Usuario_turmas;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use App\Models\Curso;
use App\Models\User;

class AlunoController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return Inertia::render('Aluno/DashboardAluno', ['user' => $user]);
    }

    public function disciplinas()
    {
        $user = Auth::user();
        $userCursoId = $user->curso_id;
        $disciplinas = Disciplina::where('curso_id', $userCursoId)->with(['curso', 'pre_requisito'])->get();
        return Inertia::render('Aluno/Disciplinas', ['user' => $user, 'disciplinas' => $disciplinas]);
    }

    public function boletim()
    {
        $user = User::where('id', Auth::user()->id)->with('curso')->first();
        $turmaAluno = DB::table('usuario_turmas')
            ->where('aluno_id', $user->id)
            ->join('turmas', 'turmas.id', '=', 'usuario_turmas.turma_id')
            ->join('disciplinas', 'disciplinas.id', '=', 'turmas.disciplina_id')
            ->join('users as professores', 'professores.id', '=', 'turmas.professor_id')
            ->select('usuario_turmas.turma_id', 'usuario_turmas.faltas', 'usuario_turmas.nota_unidade1', 'usuario_turmas.nota_unidade2', 'usuario_turmas.media_final', 'turmas.nome as nome_turma', 'disciplinas.nome as nome_disciplina', 'disciplinas.carga_horaria as carga_horaria_disciplina', 'professores.name as nome_professor')
            ->get();

        foreach ($turmaAluno as $aluno) {
            $faltas = $aluno->faltas;
            $cargaHoraria = $aluno->carga_horaria_disciplina;

            $faltasPorcentagem = ($faltas / $cargaHoraria) * 100;

            $aluno->porcentagem_faltas = $faltasPorcentagem;
        }
        
        return Inertia::render('Aluno/Boletim', ['user' => $user, 'turmas' => $turmaAluno]);
    }

    public function aviso()
    {
        return Inertia::render('AvisoAluno');
    }
}
