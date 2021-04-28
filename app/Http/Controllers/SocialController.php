<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Socialite;
use Exception;
use Auth;
use App\Models\SocialProfile;
use App\Models\User;

use App\Models\Certificado;
use App\Models\Curso_Aprobado;
use App\Models\Detalle_User_Certificado;

class SocialController extends Controller
{
    public function facebookRedirect($driver)
    {
        $drivers = ['facebook', 'google'];

        if (in_array($driver, $drivers)) {
            return Socialite::driver($driver)->redirect();
        } else {
            return redirect('login')->with('info',$driver.' no es una aplicación valida para poder loguearse');
        }
    }
    public function loginWithFacebook(Request $request, $driver)
    {
        // entra si no permites iniciar sesón desde la red social
        if ($request->get('error')){
            return redirect('auth.login');
        }

        // extraemos usuario de con el modelo Socialite
        $userSocialite = Socialite::driver($driver)->user();

        // verificamos si existe o no el usuario ( si exite va a cursos recibidos, si no existe entra y crea el user )
        $social_profile = SocialProfile::where('social_id', $userSocialite->getId())->where('social_name', $driver)->first();
        if (!$social_profile) {
            
            $user = User::where('email', $userSocialite->email)->first();
            
            if (!$user) {
                $user = User::create([
                    'name' => $userSocialite->getName(),
                    'email' => $userSocialite->getEmail(),
                    'fb_id' => $userSocialite->getId(),
                    ]);
            }

            $social_profile = SocialProfile::create([
                'user_id'=>$user->id,
                'social_id'=>$userSocialite->getId(),
                'social_name'=>$driver,
                'social_avatar'=>$userSocialite->getAvatar()
            ]);
            auth()->login($user);
            $pedirPass = TRUE;
            // return redirect('actualizacion_datos');
            return view('auth/actualizacion_datos', ['pedirPass' => $pedirPass]);
        }

        // buscamos al usuario con ese email para loguearlo
        $user = User::where('email', $userSocialite->getEmail())->first();
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

    }
}
