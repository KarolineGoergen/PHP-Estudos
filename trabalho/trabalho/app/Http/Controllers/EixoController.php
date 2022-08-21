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
        $this->authorized('viewAny', Eixo::class);

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
        $this->authorized('create', Eixo::class);


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
        $this->authorized('create', Eixo::class);


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
    public function show($id)
    {
        $this->authorized('view', Eixo::class);


        return view('eixos.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->authorized('update', Eixo::class);


        $dados = Eixo::find($id);

        if(!isset($dados)){
            return "<h1>Eixo $id não existe!</h1>";
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
    public function update(Request $request, $id)
    {
        $this->authorized('update', Eixo::class);


        $obj_eixo = Eixo::find($id);

        if(!isset($obj_eixo)){
            return "<h1>Eixo $id não existe!</h1>";
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
    public function destroy($id)
    {
        $this->authorized('delete', Eixo::class);


        Eixo::destroy($id);
        return redirect()->route('eixos.index');
    }
}