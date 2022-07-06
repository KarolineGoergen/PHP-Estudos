<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Veterinario;
use App\Models\Especialidade;

class VeterinarioController extends Controller {

    public function index() {

        $dados[0] = Veterinario::all();
        $dados[1] = Especialidade::all();

        return view('veterinarios.index', compact('dados'));
    }

    public function create() {

        $esp = Especialidade::all();
        return view('veterinarios.create', compact('esp'));
    }

   public function store(Request $request) {

        Veterinario::create([
            'crmv' => $request->crmv,
            'nome' => $request->nome,
            'id_especialidade' => $request->id_especialidade,
        ]);

        return redirect()->route('veterinarios.index');
    }

    public function show($id) {

    }

    public function edit($id) {

        $dados = Veterinario::find($id);
        $esp = Especialidade::all();

        if(!isset($dados)) { 
            return "<h1>ID: $id não encontrado!</h1>"; 
        }     

        return view('veterinarios.edit', compact('dados','esp'));        
    }

    public function update(Request $request, $id) {

        $obj = Veterinario::find($id);

        if(!isset($obj)) { 
            return "<h1>ID: $id não encontrado!"; 
        }

        $obj->fill([
            'crmv' => $request->crmv,
            'nome' => $request->nome,
            'id_especialidade' => $request->id_especialidade,
        ]);

        $obj->save();

        return redirect()->route('veterinarios.index');
        
    }

    public function destroy($id) {

        Veterinario::destroy($id);

        return redirect()->route('veterinarios.index');
    }
}