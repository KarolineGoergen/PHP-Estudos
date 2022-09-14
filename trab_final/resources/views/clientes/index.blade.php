@extends('templates.main', ['titulo' => "Clientes", 'rota' => "clientes.create", 'permission' => "App/Models/Cliente"])
@section('titulo') Clientes @endsection
@section('conteudo')

    <div class="row">
        <div class="col">
            
            <x-datalistC 
                :header="['ID','NOME', 'E-MAIL', 'TELEFONE', 'AÇÕES']" 
                :data="$dados"
                :hide="[true, true, true, true, true]" 
            />

        </div>
    </div>
@endsection