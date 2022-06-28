<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VeterinarioController extends Controller
{
    public $veterinarios = [[
        "id" => 1,
        "crmv" => 123456,
        "nome" => "João Paulo",
        "especialidade" => "Grande Porte"
    ]];

    public function __construct() {
        $aux = session('veterinarios');

        if(!isset($aux)) {
            session(['veterinarios' => $this->veterinarios]);
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dados = session('veterinarios');
        $clinica = "VetClin DWII";

        return view('veterinarios.index', compact(['dados', 'clinica']));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('veterinarios.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $aux = session('veterinarios');
        $ids = array_column($aux, 'id');

        if(count($ids) > 0) {
            $new_id = max($ids) + 1;
        }
        else {
            $new_id = 1;   
        }

        $novo = [
            "id" => $new_id,
            "crmv" => $request->crmv,
            "nome" => $request->nome,
            "especialidade" => $request->especialidade
        ];

        array_push($aux, $novo);
        session(['veterinarios' => $aux]);

        return redirect()->route('veterinarios.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $aux = session('veterinarios');
        
        $index = array_search($id, array_column($aux, 'id'));

        $dados = $aux[$index];

        return view('veterinarios.show', compact('dados'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $aux = session('veterinarios');
            
        $index = array_search($id, array_column($aux, 'id'));

        $dados = $aux[$index];    

        return view('veterinarios.edit', compact('dados'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $aux = session('veterinarios');
        
        $index = array_search($id, array_column($aux, 'id'));

        $novo = [
            "id" => $id,
            "crmv" => $request->crmv,
            "nome" => $request->nome,
            "especialidade" => $request->especialidade,
        ];

        $aux[$index] = $novo;
        session(['veterinarios' => $aux]);

        return redirect()->route('veterinarios.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $aux = session('veterinarios');
        
        $index = array_search($id, array_column($aux, 'id')); 

        unset($aux[$index]);

        session(['veterinarios' => $aux]);

        return redirect()->route('veterinarios.index');
    }
}
