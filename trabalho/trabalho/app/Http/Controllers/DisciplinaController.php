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
        if(!PermissionController::isAuthorized('disciplinas.index')){
            abort(403);
        }

        $permissions = session('user_permissions');
        $dados = Disciplina::with(['curso'])->get();
        return view('disciplinas.index', compact(['dados', 'permissions']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        if(!PermissionController::isAuthorized('disciplinas.create')){
            abort(403);
        }

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
        if(!PermissionController::isAuthorized('disciplinas.store')){
            abort(403);
        }

        $valid = [
            'nome' => 'required|max:100|min:10',
            'curso_id' => 'required',
            'carga' => 'required|max:12|min:1',

        ];

        $msg = [
            "required" => "O campo [:attribute] é obrigatório",
            "min" => "O [:attribute] deve conter no mínimo [:min]",
            "max" => "O [:attribute] deve conter no máximo [:max]",
        ];

        $request->validate($valid, $msg);

        $obj_curso = Curso::find($request->curso_id);

        if(isset($obj_curso)) {

            $obj_disciplina = new Disciplina();
            $obj_disciplina->nome = mb_strtoupper($request->nome, 'UTF-8');
            $obj_disciplina->carga = mb_strtoupper($request->carga, 'UTF-8');
            $obj_disciplina->curso()->associate($obj_curso);
            $obj_disciplina->save();

            return redirect()->route('disciplinas.index');
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
        if(!PermissionController::isAuthorized('disciplinas.show')){
            abort(403);
        }

        return view('disciplinas.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        if(!PermissionController::isAuthorized('disciplinas.edit')){
            abort(403);
        }

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
        if(!PermissionController::isAuthorized('disciplinas.update')){
            abort(403);
        }

        $obj_disciplina = Disciplina::find($id);

        if(!isset($obj_disciplina)){
            return "<h1>Curso $id não existe!</h1>";
        }

        $valid = [
            'nome' => 'required|max:100|min:10',
            'id_curso' => 'required',
            'carga' => 'required|max:12|min:1',

        ];

        $msg = [
            "required" => "O campo [:attribute] é obrigatório",
            "min" => "O [:attribute] deve conter no mínimo [:min]",
            "max" => "O [:attribute] deve conter no máximo [:max]",
        ];

        $request->validate($valid, $msg);

        $obj_curso = Curso::find($request->curso_id);

        if(isset($obj_curso)) {

            $obj_disciplina->nome = mb_strtoupper($request->nome, 'UTF-8');
            $obj_disciplina->carga = mb_strtoupper($request->carga, 'UTF-8');
            $obj_disciplina->curso()->associate($obj_curso);
            $obj_disciplina->save();

            return redirect()->route('disciplinas.index');
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
        if(!PermissionController::isAuthorized('disciplinas.destroy')){
            abort(403);
        }

        Disciplina::destroy($id);
        return redirect()->route('disciplinas.index');
    }
}
