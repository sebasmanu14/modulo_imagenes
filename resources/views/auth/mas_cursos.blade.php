<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <title>Cursos para Ti</title>
</head>

<style>
    #General {
        border: 1px solid black;
        border-radius: 10px;
        margin: auto;
        margin-top: 50px;
        margin-bottom: 50px;
        width: 850px;
        height: auto;
    }
</style>

<body>

    <x-app-layout>
        
        <!-- tabla -->
        <div class="container h-screen">
            @auth
                <div class="py-6 px-4 sm:px-10 lg:items-center">

                    <header class="mt-80 lg:mt-56 mb-lg">
                        <div class="py-6 px-4 sm:px-6 lg:items-center ">
                            <h1 class="text-3xl font-bold text-green-300 text-center">Mas cursos para ti</h1>
                        </div>
                    </header>

                    <div class="bg-green-200 shadow-md py-8 px-2 rounded">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50 border-4 shadow-md border-t-0 border-l-0 border-r-0">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-center text-sm font-bold bg-negro uppercase ">CURSO</th>
                                    <th scope="col" class="px-6 py-3 text-center text-sm font-bold bg-negro uppercase ">FECHA DE INICIO</th>
                                    <th scope="col" class="px-6 py-3 text-center text-sm font-bold bg-negro uppercase ">INFORMACION</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
            
                                <!-- Imprimimos todos los cursos -->
                                @if (isset($cursosNuevo))
                                    @foreach($cursosNuevo as $nuevo)
                                        <tr>
                                            <td class="px-6 py-2 whitespace-nowrap text-center m-auto">
                                            
                                                <div class="sm:flex block text-center">
                                                    <img class="sm:m-0 m-auto h-10 w-10 rounded-full" src="https://image.flaticon.com/icons/png/512/1567/1567341.png" alt="icono del curso">
                                                    <p class="text-lg px-5 py-2 text-gray-900 text-center border-2 shadow-sm border-t-0 border-l-0 border-r-0">{{$nuevo->nombre}}</p>
                                                </div>
                                            
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                                <span class="text-sm px-4 py-2 inline-flex leading-5 font-semibold rounded bg-green-100 text-white">{{$nuevo->horas}}</span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                                <button href="#" class="transition duration-500 ease-in-out bg-green-500 hover:bg-blue-700 text-white text-sm font-bold py-2 px-4 rounded-full">VER</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                <!-- mas tablas tr -->
                            </tbody>
                        </table>
                    </div>

                </div>
            @endauth
        </div>

        <!--======= footer =========-->
        <footer class="mt-80 footer bg-green-200 relative pt-1 border-b-2 border-blue-700">
            <div class="container mx-auto p-6">
                <div class="sm:flex sm:mt-8">
                    <div class="px-10 mt-8 sm:mt-0 sm:w-full sm:px-8 flex flex-col md:flex-row justify-between">
                        <div class="flex flex-col">
            
                            <!--======= Redes sociales =========-->
                            <span class="font-bold text-center text-gray-700 uppercase mb-2">Area Social</span>
                            <span class="my-2"><a href="https://www.facebook.com/fundacion.esquel/" class="text-blue-700  text-md hover:text-blue-500">Siguenos en Facebook</a></span>
                            <span class="my-2"><a href="https://twitter.com/FundacionEsquel" class="text-blue-700  text-md hover:text-blue-500">Siguenos en Twitter</a></span>
                            <span class="my-2"><a href="https://www.youtube.com/channel/UCS7JrWLBuGoJqhE7ZzNr3Og" class="text-blue-700  text-md hover:text-blue-500">Visítanos en Youtube</a></span>
                        </div>
                        <div class="flex flex-col">
            
                            <!--======= Contactos =========-->
                            <span class="font-bold text-center text-gray-700 uppercase mt-4 md:mt-0 mb-2">Contáctanos</span>
                            <div class="sm:text-right text-left text-white">
                                <i>Av. Colón E4-175 entre Amazonas y Foch, Ed.</i><br>
                                <i>Torres de la Colón, Mezzanine Of. 12 Quito - Ecuador</i><br>
                                <i><a href="fundacion@esquel.org.ec" class="text-blue-700  text-md hover:text-blue-500">fundacion@esquel.org.ec</a></i><br>
                                <i>+(5932) 252-0001</i><br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--======= footer =========-->
            <div class=" bg-black shadow">
                <ul class="py-5 border border-b-0 border-l-0">
                    <li class="text-center text-white "><a href="#">© 2021 Fundación Esquel</a></li>
                </ul>
            </div>

        </footer>
    </x-app-layout>

</body>
</html>
