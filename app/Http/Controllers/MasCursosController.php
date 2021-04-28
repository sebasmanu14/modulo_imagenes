<?php

namespace App\Http\Controllers;

use App\Models\Curso_Nuevo;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;

class MasCursosController extends Controller
{
    public function index()
    {
        $cursosNuevo=Curso_Nuevo::all();
        return view('auth.mas_cursos', compact('cursosNuevo'));
        
    }
}
