<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Disciplina extends Model
{
    use HasFactory;

    protected $fillable = ['nome','curso_id','carga'];

    public function aluno() {
        return $this->belongsToMany('\App\Models\Aluno', 'matriculas')
            ->withPivot('descricao');
    }

}
