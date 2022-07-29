@extends('templates.main', ['titulo' => "Alunos", 'rota' => "alunos.create"])
@section('titulo') Aluno @endsection
@section('conteudo')

    <div class="row">
        <div class="col">
            
            <x-datalistA 
                :header="['ID', 'NOME', 'CURSO', 'AÇÕES']" 
                :data="$dados"
                :hide="[true, false, true]" 
            />

        </div>
    </div>
@endsection