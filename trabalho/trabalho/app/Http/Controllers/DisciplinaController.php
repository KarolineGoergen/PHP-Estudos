<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Disciplina;
use App\Models\Curso;

class DisciplinaController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dados[0] = Disciplina::all();
        $dados[1] = Curso::all();
        return view('disciplinas.index', compact(['dados']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $dados = Curso::all();
        return view('disciplinas.create', compact('dados'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $valid = [
            'nome' => 'required|max:100|min:10',
            'id_curso' => 'required',
            'tempo' => 'required|max:12|min:1',

        ];

        $msg = [
            "required" => "O campo [:attribute] é obrigatório",
            "min" => "O [:attribute] deve conter no mínimo [:min]",
            "max" => "O [:attribute] deve conter no máximo [:max]",
        ];

        $request->validate($valid, $msg);

        Disciplina::create([
            'nome' => $request->nome,
            'id_curso' => $request->id_curso,
            'carga' => $request->carga,
        ]);

        return redirect()->route('disciplinas.index');
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
        $dados = Disciplina::find($id);
        $curso = Curso::all();

        if(!isset($dados)){
            return "<h1>Disciplina $id não existe!</h1>";
        }
        return view('disciplinas.edit', compact('dados','curso'));
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
        $obj = Disciplina::find($id);

        if(!isset($obj)){
            return "<h1>Curso $id não existe!</h1>";
        }

        $valid = [
            'nome' => 'required|max:100|min:10',
            'id_curso' => 'required',
            'tempo' => 'required|max:12|min:1',

        ];

        $msg = [
            "required" => "O campo [:attribute] é obrigatório",
            "min" => "O [:attribute] deve conter no mínimo [:min]",
            "max" => "O [:attribute] deve conter no máximo [:max]",
        ];

        $request->validate($valid, $msg);

        $obj->fill([
            'nome' => $request->nome,
            'id_curso' => $request->id_curso,
            'carga' => $request->carga,
        ]);

        $obj->save();
        return redirect()->route('disciplinas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Disciplina::destroy($id);
        return redirect()->route('disciplinas.index');
    }
}
