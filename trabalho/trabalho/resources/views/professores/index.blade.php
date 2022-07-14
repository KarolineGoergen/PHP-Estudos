@extends('templates.main', ['titulo' => "Professores", 'rota' => "professores.create"])
@section('titulo') Professores @endsection
@section('conteudo')

    <div class="row">
        <div class="col">
            
            <x-datalistP 
                :header="['ID','ATIVO', 'NOME', 'EMAIL', 'SIAPE', 'EIXO', 'AÇÕES']" 
                :data="$dados"
                :hide="[true, true, false, true, true, false, true]" 
            />

        </div>
    </div>
@endsection