@extends('templates.main', ['titulo' => "Matricular Alunos"])

@section('titulo') Matriculas @endsection

@section('conteudo')

    <div class="row">
        <div class="col">
            <x-datalistM
                :header="['DISCIPLINA', 'Matrícula']" 
                :data="$dados"
                :hide="[true, true]" 
            />
        </div>
    </div>
@endsection