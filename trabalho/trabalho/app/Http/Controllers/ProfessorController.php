<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Professor;
use App\Models\Eixo;

class ProfessorController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $this->authorize('viewAny', Professor::class);

        $permissions = session('user_permissions');
        $dados = Professor::with('eixo')->get();
        return view('professores.index', compact(['dados', 'permissions']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Professor::class);

        $dados = Eixo::all();
        return view('professores.create', compact('dados'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Professor::class);


        $valid = [
            'nome' => 'required|max:100|min:10',
            'email' => 'required|max:250|min:15|unique:professors',
            'siape' => 'required|max:10|min:8|unique:professors',
            'eixo_id' => 'required',
            'ativo' => 'required',

        ];

        $msg = [
            "required" => "O campo [:attribute] é obrigatório",
            "min" => "O [:attribute] deve conter no mínimo [:min]",
            "max" => "O [:attribute] deve conter no máximo [:max]",
            "unique" => "O campo [:attribute] já existe!",
        ];

        $request->validate($valid, $msg);

        $obj_eixo = Eixo::find($request->eixo_id);

        if(isset($obj_eixo)) {

            $obj_professor = new Professor();
            $obj_professor->nome = mb_strtoupper($request->nome, 'UTF-8');
            $obj_professor->email = mb_strtoupper($request->email, 'UTF-8');
            $obj_professor->siape = mb_strtoupper($request->siape, 'UTF-8');
            $obj_professor->ativo = mb_strtoupper($request->ativo, 'UTF-8');
            $obj_professor->eixo()->associate($obj_eixo);
            $obj_professor->save();

            return redirect()->route('professores.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Professor $professor)
    {
        $this->authorize('view', $professor);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Professor $professor)
    {
        $this->authorize('update', $professor);

        $dados = Professor::find($professor->id);
        $eixo = Eixo::all();

        if(!isset($dados)){
            return "<h1>O Professor $professor->id não existe!</h1>";
        }
        return view('professores.edit', compact('dados','eixo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Professor $professor)
    {
        $this->authorize('update', $professor);


        $obj_professor = Professor::find($professor->id);

        $valid = [
            'nome' => 'required|max:100|min:10',
            'email' => 'required|max:250|min:15',
            'siape' => 'required|max:10|min:8',
            'id_eixo' => 'required',
            'ativo' => 'required',

        ];

        $msg = [
            "required" => "O campo [:attribute] é obrigatório",
            "min" => "O [:attribute] deve conter no mínimo [:min]",
            "max" => "O [:attribute] deve conter no máximo [:max]",
            
        ];

        $request->validate($valid, $msg);

        if(!isset($obj_professor)){
            return "<h1>O Professor $professor->id não existe!</h1>";
        }

        $obj_eixo = Eixo::find($request->eixo_id);

        if(isset($obj_eixo)) {

            $obj_professor->nome = mb_strtoupper($request->nome, 'UTF-8');
            $obj_professor->email = mb_strtoupper($request->email, 'UTF-8');
            $obj_professor->siape = mb_strtoupper($request->siape, 'UTF-8');
            $obj_professor->ativo = mb_strtoupper($request->ativo, 'UTF-8');
            $obj_professor->eixo()->associate($obj_eixo);
            $obj_professor->save();

            return redirect()->route('professores.index');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Professor $professor)
    {
        $this->authorize('delete', $professor);


        Professor::destroy($professor->id);
        return redirect()->route('professores.index');
    }
}