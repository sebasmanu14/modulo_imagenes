<?php

namespace App\Http\Controllers;

use App\Models\Curso_Nuevo;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\CursoNuevoResource;
class CursoNuevoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cursosNuevo=Curso_Nuevo::all();
        return view ('mas_cursos',compact('cursosNuevo'));
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
        $cursosNuevo=new Curso_Nuevo();
        $cursosNuevo->nombre=$request->nombre;
        $cursosNuevo->horas=$request->horas;
        $cursosNuevo->información=$request->información;
        if($cursosNuevo->save()){
            return new CursoNuevoResource($cursosNuevo);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Curso_Nuevo  $curso_Nuevo
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cursosNuevo=Curso_Nuevo::findOrFail($id);
        return new  CursoNuevoResource($cursosNuevo);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Curso_Nuevo  $curso_Nuevo
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cursosNuevo=Curso_Nuevo::find($id);
        return $cursosNuevo;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Curso_Nuevo  $curso_Nuevo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $cursosNuevo= Curso_Nuevo::findOrFail($id);
        $cursosNuevo->nombre=$request->nombre;
        $cursosNuevo->horas=$request->horas;
        $cursosNuevo->información=$request->información;
        if($cursosNuevo->save()){
            return new CursoNuevoResource($cursosNuevo);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Curso_Nuevo  $curso_Nuevo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cursosNuevo=Curso_Nuevo::findOrFail($id); 
        if($cursosNuevo->delete()){
            return new CursoNuevoResource($cursosNuevo);
        }

    }
}
