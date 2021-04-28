<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/app.css')}}">
    <title>Cursos Recibidos</title>
</head>

<body>

    <x-app-layout>
        
        <!-- Contendor del contenido -->
        <div class="container h-screen">
            @auth
                <!-- Imprimimos datos del usuario ( nombre y num.cedula ) -->
                <div class="py-6 px-4 sm:px-10 lg:items-center">
                    <!--======= Inicio header =========-->
                    <header class="mt-80 lg:mt-44 mb-20">
                        <div class="py-6 px-4 sm:px-6 lg:items-center ">
                            <h1 class="text-3xl font-bold text-green-300 text-center">Cursos Recibidos</h1>
                        </div>
                    </header>
                    <!--======= Fin header=========-->
                    <ul>
                        <li>
                            <div class="flex justify-end mb-5">
                                <h3 class="text-xl font-bold leading-none mr-2">Nombre del usuario :</h3>
                                <p class="text-xl leading-none">{{ auth()->user()->name }}</p>
                            </div>
                        </li>
                        <li>
                            <div class="flex justify-end">
                                <h3 class="text-xl font-bold leading-none mr-2">Número de Cedula :</h3>
                                <p class="text-xl leading-none">{{ auth()->user()->cedula }}</p>
                            </div>
                        </li>
                    </ul>
                </div>
            
                <!-- Imprimimos cursos aprobados del usuario -->
                <div class="container py-20 mb-80">
                    <table class="container border-collapse border border-grey-100 text-lg">
                        <thead class="text-left border-collapse border border-text-white  bg-grey-100 font-bold">
                            <tr>
                                <th class="p-3 w-1/2 ">Cursos</th>
                                <th class="p-3 w-1/4 ">Horas Realizadas</th>
                                <th class="p-3 w-1/4 ">Descarga</th>
                            </tr>
                        </thead>
                        <tbody class="border-collapse border border-grey-100 ">
                            
                            @if (isset($cursosAprobado))
                                @foreach($cursosAprobado as $curso)
                                <tr class="border-collapse border border-grey-100 ">
                                    <td class="p-3">{{$curso->nombre}}</td>
                                    <td class="p-3">{{$curso->horas}}</td>
                                    <td class="p-3 text-black text-opacity-40 hover:text-opacity-100"><a href="{{ url('formulario') }}">858</a></td>
                                </tr>
                                @endforeach()
                            @endif
                            
                        </tbody>
                    </table>
                </div>
            @endauth
        </div>


        
        <!--======= footer =========-->
        <div class=" bg-white shadow">
            <div class="text-right text-green-300 shadow font-sans text-lg">
                <div class="flex justify-end py-10 px-5 hover:text-green-300 hover:bg-grey-100">
                    <ul>
                        <h3 class="font-bold">CONTÁCTANOS</h3>
                        <li>Av. Colón E4-175 entre Amazonas y Foch, Ed.</li>
                        <li>Torres de la Colón, Mezzanine Of. 12 Quito - Ecuador</li>
                        <li>fundacion@esquel.org.ec</li>
                        <li>+(5932) 252-0001</li>
                    </ul>
                </div>
            </div>
        </div>

        <!--======= footer =========-->
        <footer class=" bg-black shadow">
            <ul class="py-8 border border-b-0 border-l-0">
                <li class="text-center text-white "><a href="#" >© 2021 Fundación Esquel</a></li>
            </ul>
        </footer>



    </x-app-layout>
     
</body>
</html>
