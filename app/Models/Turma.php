<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Turma extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'semestre',
        'turno',
        'professor_id'
    ];

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
