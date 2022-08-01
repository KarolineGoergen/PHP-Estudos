<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    use HasFactory;

    protected $fillable = ['nome','sigla','tempo','id_eixo'];
    
    public function disciplina() {
        return $this->hasMany('\App\Models\Disciplina');
    }

    public function aluno() {
        return $this->hasMany('\App\Models\Aluno');
    }
}
