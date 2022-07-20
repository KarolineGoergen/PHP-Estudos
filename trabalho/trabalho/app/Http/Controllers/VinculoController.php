<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Professor;
use App\Models\Disciplina;
use App\Models\Vinculo;

class VinculoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dados[0] = Vinculo::all();
        $dados[1] = Professor::all();
        $dados[2] = Disciplina::all();
        return view('vinculos.index', compact(['dados']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $dados[0] = Vinculo::all();
        $dados[1] = Professor::where('ativo', '=', 1)->get();
        $dados[2] = Disciplina::all();
        return view('vinculos.create', compact(['dados']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $professor = $request->professor;

        foreach($professor as $itens){

            $array = explode('_',$itens);

            Vinculo::where('id_disciplina', $array[0])->forceDelete();

            Vinculo::create([
                'id_professor' => $array[1],
                'id_disciplina' => $array[0]
            ]);
        }

    
        return redirect()->route('vinculos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         Vinculo::destroy($id);

        return redirect()->route('vinculos.index');
    }
}