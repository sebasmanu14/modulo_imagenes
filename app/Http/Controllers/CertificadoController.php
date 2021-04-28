<?php
 
 
namespace App\Http\Controllers;

use App\Models\Certificado;
use Illuminate\Http\Request;
use App\Http\Resources\CertificadoResource;


class CertificadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $certificado=Certificado::all();
       return $certificado;
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
        return $request;
        $certificado=new Certificado();
        $certificado->nombre=$request->nombre;
        $certificado->fecha=$request->fecha;
        $certificado->imagen=$request->imagen->store('public/imagenes') ;
        if($certificado->save()){
            return redirect()->route('masCursos');
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Certificado  $certificado
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $certificado=Certificado::findOrFail($id);
        return new CertificadoResource($certificado);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Certificado  $certificado
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $certificado=Certificado::find($id);
        return $certificado;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Certificado  $certificado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $certificado=Certificado::findOrFail($id);
        $certificado->nombre=$request->nombre;
        $certificado->fecha=$request->fecha;
        $certificado->imagen=$request->imagen;
        if($certificado->save()){
            return new CertificadoResource($certificado);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Certificado  $certificado
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $certificado=Certificado::findOrFail($id);
        if($certificado->delete()){
            return new CertificadoResource($certificado);
        }
    }
}
