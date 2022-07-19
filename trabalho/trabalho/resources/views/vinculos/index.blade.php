@extends('templates.main', ['titulo' => "Vínculos", 'rota' => "vinculos.create"])

@section('titulo') Vínculos @endsection

@section('conteudo')

    <div class="row">
        <div class="col">
            <x-datalistV
                :header="['DISCIPLINA', 'PROFESSORES']" 
                :data="$dados"
                :hide="[true, true]" 
            />
        </div>
    </div>
@endsection