@extends('templates.main', ['titulo' => "Alunos", 'rota' => "alunos.create", 'permission' => "App/Models/Aluno"])
@section('titulo') Aluno @endsection
@section('conteudo')

    <div class="row">
        <div class="col">
            
            <x-datalistA 
                :header="['NOME', 'AÇÕES']" 
                :data="$dados"
                :hide="[true, true]" 
            />

        </div>
    </div>
@endsection