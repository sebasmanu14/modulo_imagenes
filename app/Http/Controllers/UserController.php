<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use App\Models\Curso_Aprobado;


use App\Models\Certificado;
use App\Models\Detalle_User_Certificado;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $user = User::all()->first();
        // return view('actualizacion_datos', compact('user'));
        return "Estas en index";
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        if ($request->email == null) {
            $alert = "Llena el email";
        } else {
            $user = User::where('email', $request->email)->first();

            // Le recomendamos crear cuenta por que ese usre no existe
            if (!$user) {
                $emailIncorrect = $request->email;
                $alert = "El email ". $emailIncorrect. " no esta registrado. Crea una cuenta con aquel email";
                return view('auth.crear_cuenta', ['alert' => $alert]);
            }
        }
        if ($request->password == null) {
            $user = User::where('email', $request->email)->first();

            // verifica si este user existe  en la base de datos
            if ($user) {
                $alert = $user->name. " llena el campo de contraseña";
            } else {
                $alert = "Llena el campo de contraseña";
            }
        }
        if ($request->email == null and $request->password == null) {
            $alert = "Llena todos los campos";
        }
        if (isset($alert)) {
            return view('auth.login', ['alert' => $alert]);
        }
        
        if ($request->email != null and $request->password != null) {
            $findEmail = User::where('email', $request->email)->first();

            // si existe en la base de datos el correo 
            if ($findEmail) {
                $user = User::where('email', $request->email)->where('password', $request->password)->first();

                // verificamos el password y email (entra y son correctos esos datos)
                if ($user) {

                    // logueamos al usuario
                    auth()->login($user);



                    
                    
                    // =====================================================================================================
                    // IMPRIMIMOS SOLO LOS CURSOS APROBADOS SEGÚN EL USUARIO
                    // $certificadosUsers = Certificado::all();

                    // extraemos los cursos aprobados segun el usuario
                    $userCursosAprobados = Detalle_User_Certificado::where('id_usuarios',$user->id)->get();
                    
                    // aqui guardamos los ids del detalle del certificado
                    $idsDetalle = [];
                    foreach ($userCursosAprobados as $userCA => $userCursoAprobado) {
                        array_push($idsDetalle, $userCursoAprobado->id);
                    }

                    // obetenemos los cursos aprobados
                    $cursoAprobado = [];

                    // segun el id del certificado
                    foreach ($idsDetalle as $idsDetll => $idDet) {
                        $CursosAprobados = Curso_Aprobado::where('id_detalle', $idDet)->get();
                        foreach ($CursosAprobados as $CA => $CursosApro) {
                            array_push($cursoAprobado, $CursosApro);
                        }
                    }
                    // =====================================================================================================

                    return view('auth.cursos_recibidos', ['cursosAprobado' => $cursoAprobado]);

                } else {
                    $user = User::where('email', $request->email)->first();
                    $alert = $user->name. " tu contraseña es incorrecta";
                    return view('auth.login', ['alert' => $alert]);
                }
            }
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    // un request laravel trae toda la info del formulario
    public function store(Request $request)
    {
        // verificamos que los campos esten llenos
        if ($request->email == NULL) {
            $alert = "Llena el campo de email";
            return view('auth/crear_cuenta', ['alert' => $alert]);
        }
        if ($request->password_1 == NULL or $request->password_2 == NULL) {
            $alert = "Llena los campos de contraseña";
            return view('auth/crear_cuenta', ['alert' => $alert]);
        }

        // Si el user existe en la base de datos, no entra al if a crear el mismo user
        $findUser = User::where('email', $request->email)->first();

        if (!$findUser) {

            if ($request->password_1 === $request->password_2) {
                //
            } else {
                $alert = "Las contraseñas no son iguales";
                return view('auth/crear_cuenta', ['alert' => $alert]);
            }

            $user=new User();
            $user->email=$request->email;
            $user->password=$request->password_1;
            
            $user->email_verified_at=$request->email_verified_at;
            $user->remember_token=$request->_token;
            $user->current_team_id=$request->current_team_id;
            $user->profile_photo_path=$request->profile_photo_path;
            $user->id_roles=$request->id_roles;

            if($user->save()){
                // logueamos al usuario validado
                auth()->login($user);
                // redireccionamos a otra vista
                return redirect('actualizacion_datos');
            }

        } else {
            // mensaje de correo existente
            $alert = "La dirección de correo ". $request->email. " ya esta registrada. Inicia sesión";
            return view('auth/crear_cuenta', ['alert' => $alert]);
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
        $user=User::findf0rFail($id);
        return new UserResource($user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user=User::findOrFail($id);
        return view('actualizacion_datos',compact('user'));
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

        // $this->validate($request, [
        //     'name' =>'required',
        //     'apellido' =>'required',
        //     'telefono' =>'required',
        //     'cedula' =>'required',
        //     'genero' =>'required',
        //     'password' =>'required'
        // ]);

        // verificamos que todos los campos se han direfentes de NULL
        if ($request->name == NULL or $request->apellido == NULL or $request->cedula == NULL or $request->telefono == NULL or $request->genero == NULL) {
            $alert = "Llena todos los campos";
            return view('auth/actualizacion_datos', ['alert' => $alert]);
        }
        
        // verificamos si el número de cédula que ingresa el usuario ya esta registrado
        $findUser = User::where('cedula', $request->cedula)->first();
        if ($findUser) {
            $alert = "Número de cedula ya registrado";
            return view('auth/actualizacion_datos', ['alert' => $alert]);
        }
        // verificamos si estamos pidiendo contraseña
        if (isset($request->password_1)) {
            if (isset($request->password_2)) {

                // verificamos que los campos de contraseña no esten vacios
                if ($request->password_1 == NULL or $request->password_2 == NULL) {
                    $alert = "Llena los campos de contraseñas";
                    return view('auth/actualizacion_datos', ['alert' => $alert]);
                } else {
                    // verificamos si las contraseña son iguales
                    if ($request->password_1 != $request->password_2) {
                        $alert = "Escribe lo mismo, al crear y confirmar contraseña";
                        return view('auth/actualizacion_datos', ['alert' => $alert]);
                    } else {

                    }
                }
            }
        }

        $findUser = User::where('email', $request->email)->first();
        if (!$findUser) {
            $user = User::findOrFail($id);
            $user->name=$request->input('name');
            $user->apellido=$request->input('apellido');
            $user->telefono=$request->input('telefono');
            $user->cedula=$request->input('cedula');
            $user->genero=$request->input('genero');
            if (isset($request->password_1)) {
                $user->password=$request->input('password_1');
            }
            $user->remember_token=$request->_token;

            if ($user->save()) {
                $cursosAprobado=Curso_Aprobado::all();
                // return view('auth.cursos_recibidos', compact('cursosAprobado'));
                return redirect('cursos_recibidos');
            }
        }
        return redirect('actualizacion_datos');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        if($user->delete()){
            return new UserResource($user);
        }
    }

    // mas metodos aprate de los que se crean por default
    // metodo para cerrar sessión
    public function logoutUser(Request $request) {

        // ingresa a la session y genera una nueva
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // borra datos dek usuario logueado
        auth()->logout();
        return redirect('login');
    }

    // metodo para cerrar sesión a los usuarios de redes sociales
    public function logoutUserSocialNetwork () {
        return redirect('login');
    }

    // muestra los cuersos aprobados del usuario
    public function cursosAprobados ($id) {

        
        $user = User::where('id', $id)->first();




        // =====================================================================================================
        // IMPRIMIMOS SOLO LOS CURSOS APROBADOS SEGÚN EL USUARIO
        // $certificadosUsers = Certificado::all();

        // extraemos los cursos aprobados segun el usuario
        $userCursosAprobados = Detalle_User_Certificado::where('id_usuarios',$user->id)->get();
        
        // aqui guardamos los ids del detalle del certificado
        $idsDetalle = [];
        foreach ($userCursosAprobados as $userCA => $userCursoAprobado) {
            array_push($idsDetalle, $userCursoAprobado->id);
        }

        // obetenemos los cursos aprobados
        $cursoAprobado = [];

        // segun el id del certificado
        foreach ($idsDetalle as $idsDetll => $idDet) {
            $CursosAprobados = Curso_Aprobado::where('id_detalle', $idDet)->get();
            foreach ($CursosAprobados as $CA => $CursosApro) {
                array_push($cursoAprobado, $CursosApro);
            }
        }
        // =====================================================================================================

        return view('auth.cursos_recibidos', ['cursosAprobado' => $cursoAprobado]);
    }

    public function updatePageReceivedCourses () {
        return "refrescaste la paguina";
    }

}
