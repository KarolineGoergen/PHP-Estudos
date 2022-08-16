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
        if(!PermissionController::isAuthorized('professores.index')){
            abort(403);
        }

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
        if(!PermissionController::isAuthorized('professores.create')){
            abort(403);
        }

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
        if(!PermissionController::isAuthorized('professores.store')){
            abort(403);
        }

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
    public function show($id)
    {
        if(!PermissionController::isAuthorized('professores.show')){
            abort(403);
        }
        return view('professores.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!PermissionController::isAuthorized('professores.edit')){
            abort(403);
        }

        $dados = Professor::find($id);
        $eixo = Eixo::all();

        if(!isset($dados)){
            return "<h1>O Professor $id não existe!</h1>";
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
    public function update(Request $request, $id)
    {
        if(!PermissionController::isAuthorized('professores.update')){
            abort(403);
        }

        $obj_professor = Professor::find($id);

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
            return "<h1>O Professor $id não existe!</h1>";
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
    public function destroy($id)
    {
        if(!PermissionController::isAuthorized('professores.destroy')){
            abort(403);
        }

        Professor::destroy($id);
        return redirect()->route('professores.index');
    }
}