
@extends('templates.main', ['titulo' => "Eixos", 'rota' => "eixos.create"])
@section('titulo') Eixo @endsection
@section('conteudo')

    <div class="row">
        <div class="col">
            
            <x-datalistE 
                :header="['ID', 'NOME', 'AÇÕES']" 
                :data="$dados"
                :hide="[true, false, true]" 
            />

        </div>
    </div>
@endsection