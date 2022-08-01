@extends('templates.main', ['titulo' => "Alunos", 'rota' => "alunos.create"])
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