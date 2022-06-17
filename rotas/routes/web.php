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
})->name('aluno.limite');

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
})->name('aluno.matricula');

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
        else {
            $aluno2 = "<li>".$dados[$aluno1]."</li>";
        }
        
    $aluno2 .= "</ul>";
   
    return $aluno2;
})->name('aluno.nome');

Route::get('/nota', function () {

    $tabela = "<table><tr><td><Strong>Matrícula</Strong></td><td><Strong>Aluno</Strong></td><td><Strong>Nota</Strong></td></tr>";

    $dados = array(
        array('matricula'=> 1, 'nome'=> "Karoline", "nota"=> 8),
        array('matricula'=> 2, 'nome'=> "Jonathan", "nota"=> 10),
        array('matricula'=> 3, 'nome'=> "Karine", "nota"=> 9),
        array('matricula'=> 4, 'nome'=> "Laura", "nota"=> 7),
        array('matricula'=> 5, 'nome'=> "Lisa", "nota"=> 6),
    );

    foreach($dados as $aluno) {
        $tabela .= "<tr>";
        foreach ($aluno as $key => $value) {
            $tabela .= "<td>$value</td>";
        }
        $tabela .= "</tr>";
    }

    $tabela .= "</ul></table>";
    return $tabela;

})->name('nota');

Route::get('/nota/limite/{limite}', function ($limite) {

    $tabela = "<table><tr><td><Strong>Matrícula</Strong></td><td><Strong>Aluno</Strong></td><td><Strong>Nota</Strong></td></tr>";

    $dados = array(
        array('matricula'=> 1, 'nome'=> "Karoline", "nota"=> 8),
        array('matricula'=> 2, 'nome'=> "Jonathan", "nota"=> 10),
        array('matricula'=> 3, 'nome'=> "Karine", "nota"=> 9),
        array('matricula'=> 4, 'nome'=> "Laura", "nota"=> 7),
        array('matricula'=> 5, 'nome'=> "Lisa", "nota"=> 6),
    );

    if($limite <= count($dados)){
        $cont = 0;

        foreach($dados as $aluno) {
            $tabela .= "<tr>";

            foreach ($aluno as $key => $value) {
                $tabela .= "<td>$value</td>";
            }
            $cont++;
            
            if($cont >= $limite) break;
            $tabela .= "</tr>";
        }
    }
  

    $tabela .= "</ul></table>";
    return $tabela;
})->name('nota.limite');

Route::get('nota/lancar/{nota}/{matricula}/{nome?}', function($nota, $matricula, $nome=null) {

    $tabela = "<table><tr><td><Strong>Matrícula&emsp;</Strong></td><td><Strong>Aluno&emsp;</Strong></td><td><Strong>Nota</Strong></td></tr>";

    $dados = array(
        array('matricula'=> 1, 'nome'=> "Karoline", "nota"=> 8),
        array('matricula'=> 2, 'nome'=> "Jonathan", "nota"=> 10),
        array('matricula'=> 3, 'nome'=> "Karine", "nota"=> 9),
        array('matricula'=> 4, 'nome'=> "Laura", "nota"=> 7),
        array('matricula'=> 5, 'nome'=> "Lisa", "nota"=> 6),
    );

    $aux = $dados;

    if($nome == null) {

    $indice = array_search($matricula, array_column($aux, 'matricula'));

    $alterado = [
        'matricula' => $matricula,
        'nome' => $dados[$indice]['nome'],
        'nota' => $nota
    ];

    $dados[$indice] = $alterado;

    }else {

        $indice = array_search($nome, array_column($aux, 'nome'));
        $indiceM = array_search($matricula, array_column($aux, 'matricula'));

        if($indiceM != null) {
        
        $alterado = [
            'matricula' => $matricula,
            'nome' => $nome,
            'nota' => $nota
        ];

        $dados[$indice] = $alterado;

    } else {
       
        echo "<h2>NÃO ENCONTRADO!</h2>";
    }

    }

    foreach($dados as $aluno) {
        $tabela .= "<tr>";
        foreach ($aluno as $key => $value) {
            $tabela .= "<td>$value</td>";
        }
        $tabela .= "</tr>";
    }

    $tabela .= "</ul></table>";
    return $tabela;

})->name('nota.lancar');

Route::get('nota/conceito/{A}/{B}/{C}', function($a, $b, $c) {

    $tabela = "<table><tr><td><Strong>Matrícula&emsp;</Strong></td><td><Strong>Aluno&emsp;</Strong></td><td><Strong>Nota</Strong></td></tr>";

    $dados = array(
        array('matricula'=> 1, 'nome'=> "Karoline", "nota"=> 8),
        array('matricula'=> 2, 'nome'=> "Jonathan", "nota"=> 10),
        array('matricula'=> 3, 'nome'=> "Karine", "nota"=> 9),
        array('matricula'=> 4, 'nome'=> "Laura", "nota"=> 7),
        array('matricula'=> 5, 'nome'=> "Lisa", "nota"=> 6),
    );

    $aux = $dados;

    $indiceA = array_search($a, array_column($aux, 'nota'));
    $indiceB = array_search($b, array_column($aux, 'nota'));
    $indiceC = array_search($c, array_column($aux, 'nota'));

    if($dados[$indiceA] >= 9){

        $alterado = [
            'matricula' => $dados[$indiceA]['matricula'],
            'nome' => $dados[$indiceA]['nome'],
            'nota' => "A"
        ];
        

        $dados[$indiceA] = $alterado;

    }
    if($dados[$indiceB] >= 7){

        $alterado = [
            'matricula' => $dados[$indiceB]['matricula'],
            'nome' => $dados[$indiceB]['nome'],
            'nota' => "B"
        ];
        

        $dados[$indiceB] = $alterado;
    }
    if($dados[$indiceC] >= 6){

        $alterado = [
            'matricula' => $dados[$indiceC]['matricula'],
            'nome' => $dados[$indiceC]['nome'],
            'nota' => "C"
        ];
        

        $dados[$indiceC] = $alterado;

    }
 

    foreach($dados as $aluno) {
        $tabela .= "<tr>";
        foreach ($aluno as $key => $value) {
            $tabela .= "<td>$value</td>";
        }
        $tabela .= "</tr>";
    }

    $tabela .= "</ul></table>";
    return $tabela;

})->name('nota.conceito');


