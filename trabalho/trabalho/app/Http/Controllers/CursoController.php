<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Curso;
use App\Models\Eixo;

class CursoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!PermissionController::isAuthorized('cursos.index')){
            abort(403);
        }

        $permissions = session('user_permissions');
        $dados = Curso::with(['eixo'])->get();
        return view('cursos.index', compact('dados', 'permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!PermissionController::isAuthorized('cursos.create')){
            abort(403);
        }

        $dados = Eixo::all();
        return view('cursos.create', compact('dados'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!PermissionController::isAuthorized('cursos.store')){
            abort(403);
        }

        $valid = [
            'nome' => 'required|max:50|min:10',
            'sigla' => 'required|max:8|min:2',
            'tempo' => 'required|max:2|min:1',
            'eixo_id' => 'required',

        ];

        $msg = [
            "required" => "O campo [:attribute] é obrigatório",
            "min" => "O [:attribute] deve conter no mínimo [:min]",
            "max" => "O [:attribute] deve conter no máximo [:max]",
        ];

        $request->validate($valid, $msg);

        $obj_eixo = Eixo::find($request->eixo_id);

        if(isset($obj_eixo)) {
            $obj_curso = new Curso();
            $obj_curso->nome = $request->nome;
            $obj_curso->sigla = $request->sigla;
            $obj_curso->tempo = $request->tempo;
            $obj_curso->eixo()->associate($obj_eixo);
            $obj_curso->save();
            
            return redirect()->route('cursos.index');
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
        if(!PermissionController::isAuthorized('cursos.show')){
            abort(403);
        }

        return view('cursos.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!PermissionController::isAuthorized('cursos.edit')){
            abort(403);
        }

        $dados = Curso::find($id);
        $eixo = Eixo::all();

        if(!isset($dados)) {
            return "<h1> ID: $id não encontrado! </h1>";
        }

        return view('cursos.edit', compact('dados','eixo'));
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
        if(!PermissionController::isAuthorized('cursos.update')){
            abort(403);
        }

        $obj_curso = Curso::find($id);

        $valid = [
            'nome' => 'required|max:50|min:10',
            'sigla' => 'required|max:8|min:2',
            'tempo' => 'required|max:2|min:1',
            'eixo_id' => 'required',

        ];

        $msg = [
            "required" => "O campo [:attribute] é obrigatório",
            "min" => "O [:attribute] deve conter no mínimo [:min]",
            "max" => "O [:attribute] deve conter no máximo [:max]",
        ];
        
        $request->validate($valid, $msg);

        if(!isset($obj_curso)) { 

            return "<h1>ID: $id não encontrado! </h1>"; 
        }

        $obj_eixo = Eixo::find($request->eixo_id);

        if(isset($obj_curso)) {

            $obj_curso->nome = mb_strtoupper($request->nome, 'UTF-8');
            $obj_curso->sigla = mb_strtoupper($request->sigla, 'UTF-8');
            $obj_curso->tempo = mb_strtoupper($request->tempo, 'UTF-8');
            $obj_curso->eixo()->associate($obj_eixo);
            $obj_curso->save();

            return redirect()->route('cursos.index');
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
        if(!PermissionController::isAuthorized('cursos.destroy')){
            abort(403);
        }

        Curso::destroy($id);
        return redirect()->route('cursos.index');
    }
}