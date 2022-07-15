@extends('templates.main', ['titulo' => "Disciplinas", 'rota' => "disciplinas.create"])
@section('titulo') Disciplinas @endsection
@section('conteudo')

    <div class="row">
        <div class="col">
            
            <x-datalistD 
                :header="['ID', 'NOME', 'CURSO', 'CARGA', 'AÇÕES']" 
                :data="$dados"
                :hide="[true, false, true, false, true]" 
            />

        </div>
    </div>
@endsection