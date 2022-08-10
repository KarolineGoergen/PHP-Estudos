<?php

namespace App\Http\Controllers;
use App\Models\Matricula;
use App\Models\Aluno;
use App\Models\Disciplina;
use Illuminate\Http\Request;

class MatriculaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $matriculas = $request->matriculas;
        $obj_aluno = Aluno::find($request->aluno);
        Matricula::where('aluno_id', $obj_aluno->id)->forceDelete();
        
        if($matriculas != null){
            foreach($matriculas as $mat){

                $obj_disciplina = Disciplina::find($mat);
    
                if(!isset($obj_aluno) || !isset($obj_disciplina)) { 
                    return "<h1>id não encontrado!"; 
                }
    
                $obj = new Matricula();
                $obj->aluno()->associate($obj_aluno);
                $obj->disciplina()->associate($obj_disciplina);
                $obj->save();
            }
    
            return redirect()->route('alunos.index');

        }
        else{
            return redirect()->route('alunos.index');
        }
        
    
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
        //
    }
}
