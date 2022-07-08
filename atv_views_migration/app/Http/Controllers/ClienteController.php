<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;

class ClienteController extends Controller {
    
    public function index() {
        $dados = Cliente::all();
        return view('clientes.index', compact('dados'));
    }

    public function create() {

        return view('clientes.create');
    }

   public function store(Request $request) {

    $regras = [
        'nome' => 'required|max:100|min:10',
        'email' => 'required|max:150|min:15|unique:clientes',

    ];

    $msg = [
        "required" => "O campo [:attribute] é obrigatório",
        "min" => "O [:attribute] deve conter no mínimo [:min]",
        "max" => "O [:attribute] deve conter no máximo [:max]",
        "unique" => "O [:attribute] já existe!",
        
    ];

    $request->validate($regras, $msg);

        Cliente::create([
            'nome' => $request->nome,
            'email' => $request->email,
        ]);

        return redirect()->route('clientes.index');
    }

    public function show($id) {

    }

    public function edit($id) {

        $dados = Cliente::find($id);

        if(!isset($dados)) { 
            return "<h1>ID: $id não encontrado!</h1>"; 
        }     

        return view('clientes.edit', compact('dados'));        
    }

    public function update(Request $request, $id) {

        $obj = Cliente::find($id);

        if(!isset($obj)) { 
            return "<h1>ID: $id não encontrado!"; 
        }

        $obj->fill([
            'nome' => $request->nome,
            'email' => $request->email,
        ]);

        $obj->save();

        return redirect()->route('clientes.index');
        
    }

    public function destroy($id) {

        Cliente::destroy($id);

        return redirect()->route('clientes.index');
    }
}