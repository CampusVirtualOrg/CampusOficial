<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matricula extends Model
{
    use HasFactory;

    protected $fillable = [
        'aluno_id',
        'curso_id'
    ];

	public function user()
	{
		return $this->hasOne(User::class);
	}

	public function curso()
	{
		return $this->hasOne(Curso::class);
	}
}
