<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EspecialidadeController extends Controller
{
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dados = Especialidade::all();
        return view('especialidades.index', compact('dados'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('especialidades.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Endereco::create([
            'nome' => mb_strtoupper($request->nome, 'UTF-8'),
            'descricao' => mb_strtoupper($descricao->rua, 'UTF-8'),
        ]);
        
        return redirect()->route('especialidades.index');
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
        $dados = Especialidade::find($id);

        if(!isset($dados)) { return "<h1>ID: $id não encontrado!</h1>"; }

        return view('especialidades.edit', compact('dados'));
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
        $obj = Especialidade::find($id);

        if(!isset($obj)) { return "<h1>ID: $id não encontrado!"; }

        $obj->fill([
            'nome' => mb_strtoupper($request->nome, 'UTF-8'),
            'descricao' => mb_strtoupper($descricao->rua, 'UTF-8'),
        ]);

        $obj->save();

        return redirect()->route('especialidades.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $obj = Especialidade::find($id);

        if(!isset($obj)) { return "<h1>ID: $id não encontrado!"; }

        $obj->destroy();

        return redirect()->route('especialidades.index');
    }
}
