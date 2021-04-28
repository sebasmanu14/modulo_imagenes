<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Curso_Aprobado;
use Illuminate\Http\Request;
use App\Http\Resources\CursoAprobadoResource;

class CursoAprobadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return "Estamos viendo los cursos aprobados";
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { 
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cursoAprobado=new Curso_Aprobado();
        $cursoAprobado->nombre=$request->nombre;
        $cursoAprobado->horas=$request->horas;
        $cursoAprobado->id_encuesta=$request->id_encuesta;
        $cursoAprobado->id_detalle=$request->id_detalle;
        if($cursoAprobado->save()){
            return new CursoAprobadoResource($cursoAprobado);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Curso_Aprobado  $curso_Aprobado
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cursoAprobado=Curso_Aprobado::findOrFail($id);
        return new CursoAprobadoResource($cursoAprobado);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Curso_Aprobado  $curso_Aprobado
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cursoAprobado=Curso_Aprobado::find($id);
        return $cursoAprobado;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Curso_Aprobado  $curso_Aprobado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $cursoAprobado=Curso_Aprobado::find($id);
        $cursoAprobado->nombre=$request->nombre;
        $cursoAprobado->horas=$request->horas;
        $cursoAprobado->id_encuesta=$request->id_encuesta;
        $cursoAprobado->id_detalle=$request->id_detalle;
        if($cursoAprobado->save()){
            return new CursoAprobadoResource($cursoAprobado);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Curso_Aprobado  $curso_Aprobado
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cursoAprobado=Curso_Aprobado::find($id);
        if($cursoAprobado->save()){
            return new CursoAprobadoResource($cursoAprobado);
        }
    }
}
