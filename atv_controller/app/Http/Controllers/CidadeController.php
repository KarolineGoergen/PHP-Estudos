<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CidadeController extends Controller {

    public $cidades = [[
        'id' => 1,
        'nome' => 'Pontal do Paraná',
        'porte' => 'Pequena'
    ],
   
];

    public function __construct() {

        $aux = session('cidades');

        if(!isset($aux)) {
            session(['cidades' => $this->cidades]);
        }
    }

    public function index() {

       $cidades = session('cidades');
       return view('cidades.index', compact('cidades'));
    }

    public function create() {

        return view('cidades.create');
    }

    public function store(Request $request) {

       $aux = session('cidades');
       
       $ids = array_column($aux, 'id');
       
       if(count($ids) > 0) {
           $new_id = max($ids) + 1;
       }
       else {
           $new_id = 1;
       }

       $novo = [
        'id' => $new_id,
        'nome' => $request->nome,
        'porte' => $request->porte

        ];
       
       array_push($aux, $novo);
       
       session(['cidades' => $aux]);
       
       return redirect()->route('cidades.index');
    }

    public function show($id) {
        
       $aux = session('cidades');

       $indice = array_search($id, array_column($aux, 'id'));

       $dados = $aux[$indice];
       
       return view('cidades.show', compact('dados'));
    }

    public function edit($id) {

       $aux = session('cidades');

       $indice = array_search($id, array_column($aux, 'id'));

       $dados = $aux[$indice];

       return view('cidades.edit', compact('dados')); 
    }

    public function update(Request $request, $id) {
        
       $alterado = [
        'id' => $id,
        'nome' => $request->nome,
        'porte' => $request->porte
        ];

        $aux = session('cidades');
        
        $indice = array_search($id, array_column($aux, 'id'));
        
        $aux[$indice] = $alterado;
        
        session(['cidades' => $aux]);
        
        return redirect()->route('cidades.index');
    }

    public function destroy($id) {
        
        $aux = session('cidades');

        $indice = array_search($id, array_column($aux, 'id'));
        
        unset($aux[$indice]);
        
        session(['cidades' => $aux]);
        
        return redirect()->route('cidades.index');
    }

}
   
