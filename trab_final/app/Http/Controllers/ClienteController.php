<?php

namespace App\Http\Controllers;
use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', Cliente::class);

        $permissions = session('user_permissions');
        $dados = Cliente::all();
        return view('clientes.index', compact('dados', 'permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Cliente::class);

        return view('clientes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Cliente::class);

        $obj_cliente = new Cliente();
        $obj_cliente->nome = mb_strtoupper($request->nome, 'UTF-8');
        $obj_cliente->email = mb_strtoupper($request->nome, 'UTF-8');
        $obj_cliente->telefone = $request->telefone;
        $obj_cliente->save();

        return redirect()->route('clientes.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Cliente $cliente)
    {
        $this->authorize('view', $cliente);

        return view('clientes.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Cliente $cliente)
    {
        $this->authorize('update', $cliente);


        $dados = Cliente::find($cliente->id);

        if(!isset($dados)){
            return "<h1>Cliente $cliente->id não existe!</h1>";
        }
        return view('clientes.edit', compact('dados'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cliente $cliente )
    {
        $this->authorize('update', $cliente);


        $obj_cliente = Cliente::find($cliente->id);

        if(!isset($obj_cliente)){
            return "<h1>Cliente $cliente->id não existe!</h1>";
        }

        $obj_cliente->nome = mb_strtoupper($request->nome, 'UTF-8');
        $obj_cliente->email = mb_strtoupper($request->nome, 'UTF-8');
        $obj_cliente->telefone = $request->telefone;
        $obj_cliente->save();

        return redirect()->route('clientes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cliente $cliente)
    {
        $this->authorize('delete', $cliente);

        Cliente::destroy($cliente->id);
        return redirect()->route('clientes.index');
    }
}
