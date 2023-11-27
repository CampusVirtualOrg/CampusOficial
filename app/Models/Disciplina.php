<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disciplina extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'sigla',
        'carga_horaria',
        'pre_requisito_id',
        'curso_id',
    ];

    public function pre_requisito()
	{
		return $this->belongsTo(Disciplina::class);
	}

	public function curso()
	{
		return $this->belongsTo(Curso::class);
	}

	public function turma(){
		return $this->hasMany(Turma::class);
	}
}
