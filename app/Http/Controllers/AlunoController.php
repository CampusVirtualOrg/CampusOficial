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

    }

    public function aviso()
    {
        return Inertia::render('AvisoAluno');
    }

}
