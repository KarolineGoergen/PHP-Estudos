<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('templates.main')->with('titulo', "");
})->name('index');

Route::resource('eixos', 'App\Http\Controllers\EixoController');
Route::resource('cursos', 'App\Http\Controllers\CursoController');
Route::resource('professores', 'App\Http\Controllers\ProfessorController');
Route::resource('disciplinas', 'App\Http\Controllers\DisciplinaController');
Route::resource('vinculos', 'App\Http\Controllers\VinculoController');
Route::resource('alunos', 'App\Http\Controllers\AlunoController');
Route::resource('matriculas', 'App\Http\Controllers\MatriculaController');
