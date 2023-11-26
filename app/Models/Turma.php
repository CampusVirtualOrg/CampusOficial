<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Turma extends Model
{
    use HasFactory;

	protected $table = 'turmas';

    protected $fillable = [
        'nome',
        'semestre',
        'turno',
        'horario',
        'disciplina_id',
    ];

	public function disciplina()
	{
		return $this->belongsTo(Disciplina::class);
	}

	public function professor()
	{
		return $this->belongsTo(Professor::class);
	}

	public function alunos()
	{
		return $this->belongsToMany(Users::class,
			'usuario_turmas',
			'turma_id',
			'aluno_id');
	}
}
