<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Professor;

class ProfessorController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dados = Professor::all();
        $dados2 = Eixo::all();
        return view('professores.index', compact(['dados','dados2']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('professores.create');
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
            'email' => 'required|max:250|min:15|unique:professors',
            'siape' => 'required|max:10|min:8|unique:professors',
            'id_eixo' => 'required',
            'ativo' => 'required',

        ];

        $msg = [
            "required" => "O campo [:attribute] é obrigatório",
            "min" => "O [:attribute] deve conter no mínimo [:min]",
            "max" => "O [:attribute] deve conter no máximo [:max]",
            "unique" => "O campo [:attribute] já existe!",
        ];

        $request->validate($valid, $msg);

        Professor::create([
            'nome' => $request->nome,
            'email' => $request->email,
            'siape' => $request->siape,
            'id_eixo' => $request->id_eixo,
            'ativo' => $request->ativo,
        ]);

        return redirect()->route('professores.index');
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
        $dados = Professor::find($id);

        if(!isset($dados)){
            return "<h1>O Professor $id não existe!</h1>";
        }
        return view('professores.edit', compact('dados'));
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
        $obj = Professor::find($id);

        if(!isset($obj)){
            return "<h1>O Professor $id não existe!</h1>";
        }

        $valid = [
            'nome' => 'required|max:100|min:10',
            'email' => 'required|max:250|min:15|unique:professors',
            'siape' => 'required|max:10|min:8|unique:professors',
            'id_eixo' => 'required',
            'ativo' => 'required',

        ];

        $msg = [
            "required" => "O campo [:attribute] é obrigatório",
            "min" => "O [:attribute] deve conter no mínimo [:min]",
            "max" => "O [:attribute] deve conter no máximo [:max]",
            "unique" => "O campo [:attribute] já existe!",
        ];

        $request->validate($valid, $msg);

        $obj->fill([
            'nome' => $request->nome,
            'email' => $request->email,
            'siape' => $request->siape,
            'id_eixo' => $request->id_eixo,
            'ativo' => $request->ativo,
        ]);

        $obj->save();
        return redirect()->route('professores.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Professor::destroy($id);
        return redirect()->route('professores.index');
    }
}
