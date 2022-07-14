@extends('templates.main', ['titulo' => "Cursos", 'rota' => "cursos.create"])
@section('titulo') Cursos @endsection
@section('conteudo')

    <div class="row">
        <div class="col">
            
            <x-datalistC 
                :header="['ID', 'NOME', 'SIGLA', 'TEMPO', 'EIXO', 'AÇÕES']" 
                :data="$dados"
                :hide="[true, false, true, true, false, true]" 
            />

        </div>
    </div>
@endsection