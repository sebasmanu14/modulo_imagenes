<?php

use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\ActualizarDatosController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CursoAprobadoController;
use App\Http\Controllers\EncuestaController;
use App\Http\Controllers\MasCursosController;
use App\Http\Controllers\CursoNuevoController;
use App\Http\Controllers\CertificadoController;



// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');






// http://localhost:8000/login/facebook/callback

Route::get('/', function () {
    return view('auth/login');
});    

Route::get('login', function () {
    return view('auth/login');
});



// http://localhost:8000/login/facebook/callback?code=AQAkbbK2a7W__TbEHgx2ESskMjjV

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

// ->middleware(['auth'])->name('login')



Route::get('createUser', [UserController::class, 'store'])->name('createUser');
Route::get('checkUser', [UserController::class, 'create'])->name('checkUser');
Route::put('updateUser/{id}', [UserController::class, 'update'])->name('updateUser');
Route::get('masCursos', [MasCursosController::class, 'index'])->name('masCursos');
Route::post('subirCertificados',[CertificadoController::class, 'store'])->name('subirCertificados');

Route::get('subir_certificados', function () {
    return view('auth/subir_certificados');
});


Route::get('cursosAprobadosUser/{id}', [UserController::class, 'cursosAprobados'])->name('cursosAprobadosUser/{id}');

Route::get('logout', [UserController::class, 'logoutUser'])->name('logout');

// cierra sesión al usuario de red social
Route::get('/login/{driver}/logout', [UserController::class, 'logoutUserSocialNetwork'])->name('/login/{driver}/logout');

// resualve error al recargar pagina despues de loguearse por red social
Route::get('/login/{driver}/callback', [UserController::class, 'updatePageReceivedCourses'])->name('/login/{driver}/callback');


// redirige al usuario ya existente a cursos recibidos
Route::get('login/{driver}', [SocialController::class, 'facebookRedirect']);

// crea usuario de redes sociales
Route::get('login/{driver}/callback', [SocialController::class, 'loginWithFacebook']);







// Comienza devolución de vistas
Route::get('perfil', function () {
    return view('profile/show');
})->name('perfil');

Route::get('actualizacion_datos', function () {
    return view('auth/actualizacion_datos');
});

Route::get('crear_cuenta', function () {
    return view('auth/crear_cuenta');
});

Route::get('cursos_recibidos', function () {
    return view('auth/cursos_recibidos');
});

Route::get('formulario', function () {
    return view('auth/formulario');
});

Route::get('mas_cursos', function () {
    return view('auth/mas_cursos');
});

Route::get('nuevos_cursos', function () {
    return view('auth/nuevos_cursos');
});


// Termina devolución de vistas
