@extends('templates.main', ['titulo' => "Empresas", 'rota' => "empresas.create", 'permission' => "App/Models/Empresa"])
@section('titulo') Empresas @endsection
@section('conteudo')

    <div class="row">
        <div class="col">
            
            <x-datalistE 
                :header="['ID','NOME', 'DESCRIÇÃO', 'TELEFONE', 'CNPJ', 'AÇÕES']" 
                :data="$dados"
                :hide="[true, true, true, true, true, true]" 
            />

        </div>
    </div>
@endsection