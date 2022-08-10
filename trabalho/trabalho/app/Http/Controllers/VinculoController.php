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
        $professores = $request->professores;

        foreach($professores as $ids){
            $arr = explode("_", $ids);
            Vinculo::where('disciplina_id', $arr[0])->forceDelete();
            $obj_disciplina = Disciplina::find($arr[0]);
            $obj_professor = Professor::find($arr[1]);

            if(!isset($obj_disciplina) || !isset($obj_professor)) { 
                return "<h1>ID: id não encontrado!"; 
            }

            $obj = new Vinculo();
            $obj->professor()->associate($obj_professor);
            $obj->disciplina()->associate($obj_disciplina);

            $obj->save();
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