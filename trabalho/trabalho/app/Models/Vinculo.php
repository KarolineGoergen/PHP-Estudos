<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vinculo extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['disciplina_id', 'professor_id'];
}
