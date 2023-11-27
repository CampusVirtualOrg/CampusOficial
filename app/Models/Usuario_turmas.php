<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario_turmas extends Model
{
    use HasFactory;

    protected $fillable = [
        'aluno_id',
        'turma_id',
        'faltas',
        'nota_unidade1',
        'nota_unidade2',
        'media_final',
    ];

    protected $table = 'usuario_turmas';
    }
