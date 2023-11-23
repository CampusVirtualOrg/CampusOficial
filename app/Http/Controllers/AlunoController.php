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

    public function disciplinas(String $userId)
    {
        $disciplinas = Usuario_turmas::where('aluno_id', $userId)->get();
        $disciplinaIds = $disciplinas->pluck('disciplina_id');
        $disciplinasEncontradas = Disciplina::whereIn('id', $disciplinaIds)->select('nome')->get();
    }

    public function boletim()
    {
		$user = Auth::user();

		$curso = $user->matricula;
		$turmas = $user->turmas;

		return Inertia::render('Aluno/Boletim', ['user' => $user, 'turmas' => $turmas ]);
    }

    public function aviso()
    {
        return Inertia::render('AvisoAluno');
    }

}
