<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    use HasFactory;

    protected $fillable = [
			'nome',
			'carga_horaria',
			'periodos',
			'sigla',
			'categoria',
			'descricao',
    ];

	public function matriculas()
	{
		return $this->hasMany(Matricula::class);
	}
}
