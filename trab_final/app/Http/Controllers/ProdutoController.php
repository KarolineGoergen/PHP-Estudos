<?php

namespace App\Http\Controllers;
use App\Models\Produto;
use App\Models\Empresa;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', Produto::class);

        $permissions = session('user_permissions');
        $dados = Produto::with('empresa')->get();
        return view('produtos.index', compact(['dados', 'permissions']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Produto::class);

        $dados = Empresa::all();
        return view('produtos.create', compact('dados'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Produto::class);

        $obj_empresa = Empresa::find($request->empresa_id);
        if(isset($obj_empresa)){

            $obj_produto = new Produto();
            $obj_produto->nome = mb_strtoupper($request->nome, 'UTF-8');
            $obj_produto->descricao = mb_strtoupper($request->descricao, 'UTF-8');
            $obj_produto->valor = $request->valor;
            $obj_produto->empresa()->associate($obj_empresa);
            $obj_produto->save();

            return redirect()->route('produtos.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Produto $produto)
    {
        $this->authorize('view', $produto);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Produto $produto)
    {
        $this->authorize('update', $produto);

        $dados = Produto::find($produto->id);
        $empresa = Empresa::all();

        if(!isset($dados)){
            return "<h1>O Produto $produto->id não existe!</h1>";
        }
        return view('produtos.edit', compact('dados','empresa'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Produto $produto)
    {
        $this->authorize('update', $produto);

        $obj_empresa = Empresa::find($request->empresa_id);
        $obj_produto = Produto::find($produto->id);

        if(isset($obj_empresa)){

            $obj_produto->nome = mb_strtoupper($request->nome, 'UTF-8');
            $obj_produto->descricao = mb_strtoupper($request->descricao, 'UTF-8');
            $obj_produto->valor = $request->valor;
            $obj_produto->empresa()->associate($obj_empresa);
            $obj_produto->save();

            return redirect()->route('produtos.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Produto $produto)
    {
        $this->authorize('delete', $produto);

        Produto::destroy($produto->id);
        return redirect()->route('produtos.index');
    }
}
