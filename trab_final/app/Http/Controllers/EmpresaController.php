<?php

namespace App\Http\Controllers;
use App\Models\Empresa;
use Illuminate\Http\Request;

class EmpresaController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', Empresa::class);

        $permissions = session('user_permissions');
        $dados = Empresa::all();
        return view('empresas.index', compact('dados', 'permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Cliente::class);

        return view('empresas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Empresa::class);

        $obj_empresa = new Empresa();
        $obj_empresa->nome = mb_strtoupper($request->nome, 'UTF-8');
        $obj_empresa->descricao = mb_strtoupper($request->descricao, 'UTF-8');
        $obj_empresa->telefone = $request->telefone;
        $obj_empresa->cod = $request->cod;
        $obj_empresa->save();

        return redirect()->route('empresas.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Empresa $empresa)
    {
        $this->authorize('view', $empresa);

        return view('empresas.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Empresa $empresa)
    {
        $this->authorize('update', $empresa);


        $dados = Empresa::find($empresa->id);

        if(!isset($dados)){
            return "<h1>Empresa $empresa->id não existe!</h1>";
        }
        return view('empresas.edit', compact('dados'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Empresa $empresa )
    {
        $this->authorize('update', $empresa);


        $obj_empresa = Empresa::find($empresa->id);

        if(!isset($obj_empresa)){
            return "<h1>Empresa $empresa->id não existe!</h1>";
        }

        $obj_empresa->nome = mb_strtoupper($request->nome, 'UTF-8');
        $obj_empresa->descricao = mb_strtoupper($request->descricao, 'UTF-8');
        $obj_empresa->telefone = $request->telefone;
        $obj_empresa->cod = $request->cod;
        $obj_empresa->save();

        return redirect()->route('empresas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Empresa $empresa)
    {
        $this->authorize('delete', $empresa);

        Empresa::destroy($empresa->id);
        return redirect()->route('empresas.index');
    }
}
