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


class AlunoController extends Controller
{
    public function index()
    {
		$user = Auth::user();
        return Inertia::render('DashboardAluno', ['user' => $user]);
    }

    public function disciplinas()
    {   
        $user = Auth::user();
        $userCursoId = $user->curso_id;
        $disciplinas = Disciplina::where('curso_id', $userCursoId)->get();
        return Inertia::render('Aluno/Disciplinas', ['user' => $user, 'disciplinas' => $disciplinas]);
    }

    public function boletim()
    {
		$user = Auth::user();
		$turmas = $user->turmas;
        $userCursoId = $user->curso_id;
        $disciplinas = Disciplina::where('curso_id', $userCursoId)->get();

		return Inertia::render('Aluno/Boletim', ['user' => $user, 'turmas' => $turmas, 'disciplinas' => $disciplinas]);
    }

    public function aviso()
    {
        return Inertia::render('AvisoAluno');
    }

}
