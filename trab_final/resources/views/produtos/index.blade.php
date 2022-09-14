@extends('templates.main', ['titulo' => "Produtos", 'rota' => "produtos.create", 'permission' => "App/Models/Produto"])
@section('titulo') Produtos @endsection
@section('conteudo')

    <div class="row">
        <div class="col">
            
            <x-datalistP 
                :header="['ID', 'NOME', 'DESCRIÇÃO', 'VALOR', 'EMPRESA', 'AÇÕES']" 
                :data="$dados"
                :hide="[true, true, true, true, true, true]" 
            />

        </div>
    </div>
@endsection