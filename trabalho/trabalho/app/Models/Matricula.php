<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matricula extends Model
{
    use HasFactory;

    protected $fillable = ['aluno_id', 'disciplina_id'];

    public function aluno() {
        return $this->belongsTo('App\Models\Aluno');
    }
    
    public function disciplina() {
        return $this->belongsTo('App\Models\Disciplina');
    }
}
