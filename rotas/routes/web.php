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
    return "<h1>Principal</h2>";
});


Route::get('/aluno', function() {

    $alunos = "<ul>
        <li>Karoline</li>
        <li>Jonathan</li>
        <li>Karine</li>
        <li>Laura</li>
        <li>Lisa</li>
    </ul>";

    return $alunos;

})->name('aluno');

Route::get('/aluno/limite/{limite}', function ($limite) {
   
    $dados = array(
        "1-Karoline",
        "2-Jonathan",
        "3-Karine",
        "4-Laura",
        "5-Lisa"
    );

    $alunos = "<ul>";

    if($limite <=count($dados)){
        $cont = 0;
        foreach($dados as $nome){
            $alunos .= "<li>$nome</li>";
            $cont++;
            if($cont >= $limite) break;
        }
    }
    else{
        $alunos = $alunos."<h2>NÃO ENCONTRADO!</h2>";
    }

    $alunos .= "</ul>";
    return $alunos;
});

Route::get('/aluno/matricula/{matricula}', function ($matricula) {
   
    $dados = array(
        1 => "1-Karoline",
        2 => "2-Jonathan",
        3 => "3-Karine",
        4 => "4-Laura",
        5 => "5-Lisa"
    );

    $alunos = "<ul>";

    if($matricula >count($dados)){
        $alunos = $alunos."<h2>NÃO ENCONTRADO!</h2>"; 
    }
    else{
        $alunos .= $dados[$matricula];
    }
   
    $alunos .= "</ul>";

    return $alunos;
});

Route::get('/aluno/nome/{nome}', function ($nome) {
   
    $dados = array(
        1 => "Karoline",
        2 => "Jonathan",
        3 => "Karine",
        4 => "Laura",
        5 => "Lisa"
    );

    $aluno2 = "<ul>";

    $alunos = array_search("$nome",$dados);

        $aluno1 = $alunos;
        if($aluno1 <= 0){
            $aluno2 = "<h2>NÃO ENCONTRADO!</h2>";
        }
        else if(strcmp($aluno2,$nome)){
            $aluno2 = "<li>".$dados[$aluno1]."</li>";
        }
        
    $aluno2 .= "</ul>";
   
    return $aluno2;
});

