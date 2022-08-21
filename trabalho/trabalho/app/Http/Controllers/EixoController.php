<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Eixo;


class EixoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', Eixo::class);

        $permissions = session('user_permissions');
        $dados = Eixo::all();
        return view('eixos.index', compact('dados', 'permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Eixo::class);


        return view('eixos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Eixo::class);


        $valid = [
            'nome' => 'required|max:50|min:10',
        ];

        $msg = [
            "required" => "O campo [:attribute] é obrigatório",
            "min" => "O [:attribute] deve conter no mínimo [:min]",
            "max" => "O [:attribute] deve conter no máximo [:max]",
        ];

        $request->validate($valid, $msg);

        $obj_eixo = new Eixo();
        $obj_eixo->nome = mb_strtoupper($request->nome, 'UTF-8');
        $obj_eixo->save();

        return redirect()->route('eixos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Eixo $eixo)
    {
        $this->authorize('view', $eixo);


        return view('eixos.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Eixo $eixo)
    {
        $this->authorize('update', $eixo);


        $dados = Eixo::find($eixo->id);

        if(!isset($dados)){
            return "<h1>Eixo $eixo->id não existe!</h1>";
        }
        return view('eixos.edit', compact('dados'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Eixo $eixo)
    {
        $this->authorize('update', $eixo);


        $obj_eixo = Eixo::find($eixo->id);

        if(!isset($obj_eixo)){
            return "<h1>Eixo $eixo->id não existe!</h1>";
        }

        $valid = [
            'nome' => 'required|max:50|min:10',
        ];

        $msg = [
            "required" => "O campo [:attribute] é obrigatório",
            "min" => "O [:attribute] deve conter no mínimo [:min]",
            "max" => "O [:attribute] deve conter no máximo [:max]",
        ];

        $request->validate($valid, $msg);

        $obj_eixo->nome = mb_strtoupper($request->nome, 'UTF-8');
        $obj_eixo->save();

        return redirect()->route('eixos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Eixo $eixo)
    {
        $this->authorize('delete', $eixo);


        Eixo::destroy($eixo->id);
        return redirect()->route('eixos.index');
    }
}