<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Disciplina extends Model
{
    use HasFactory;

    protected $fillable = ['nome','curso_id','carga'];

    public function curso() {
        return $this->belongsTo('App\Models\Curso');
    }

}
