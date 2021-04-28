<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Actualizacion</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css')}}">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=PT+Sans&display=swap" rel="stylesheet">
</head>
<body class="bg-grey-100">

    {{-- <div class="p-10">
        {{ auth()->user()->id }}
    </div> --}}

    {{-- max-w-3xl --}}
    <div class="mx-10">

        <div class=" bg-white my-20 py-24 px-3 sm:px-6 md:px-7 lg:px-9 xl:px-12 2xl:px-16 rounded">
            
            <div class="container">
                @if ($errors->all())
                    <ul class="bg-red-100 p-5 text-white my-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
        
                <!-- header (logos fundación esquel) -->
                <div class=" grid grid-cols-1 md:grid-cols-2 gap-5">
                    <a class="m-auto" href="https://www.esquel.org.ec/">
                        <img src="https://www.esquel.org.ec/templates/g5_hydrogen/custom/images/Logo%20Esquel%20Horizontal.svg" alt="logo" width="250" height="250" link="https://www.esquel.org.ec/" >
                    </a>
                    <a class="m-auto" href="https://esquelclic.org/">
                        <img src="https://esquelclic.org/images/logos/LogoCLIC%20.svg" alt="logo" width="250" height="250">
                    </a> 
                </div>
        
            </div>
            
            <h1 class='text-center text-4xl mt-16 py-10'>Actualiza tus datos</h1>
            @auth
                
                <form action="{{ route('updateUser', auth()->user()->id) }}" method="POST"
                    class="mt-16">
                    @csrf
                    @method('PUT')
                    <div class="grid gap-x-10 grid-rows-1 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-5">
                        <label class="font-sans uppercase tracking-wide text-gray-500 hover:text-black w-50 text-xl">Nombres
                            <input value="{{ auth()->user()->name }}" name="name" type="text" placeholder="Lucia Mary" class="mt-3 block border border-gray-500 hover:border-black w-full p-3 rounded mb-4 text-blue-800 transition duration-300 ease-in-out transform">
                        </label>
                    
                        <label class="font-sans uppercase tracking-wide text-gray-500 hover:text-black w-50 text-xl">Apellidos
                            <input name="apellido" type="text" placeholder="Garcia Perez" class="mt-3 block border border-gray-500 hover:border-black w-full p-3 rounded mb-4 text-blue-800 transition duration-300 ease-in-out transform">
                        </label>
                
                        <label class="font-sans uppercase tracking-wide text-gray-500 hover:text-black w-50 text-xl">Cédula o pasaporte
                            <input name="cedula" type="text" placeholder="1254896352" class="mt-3 block border border-gray-500 hover:border-black w-full p-3 rounded mb-4 text-blue-800 transition duration-300 ease-in-out transform">
                        </label>
                
                        <label class="font-sans uppercase tracking-wide text-gray-500 hover:text-black w-50 text-xl">Celular
                            <input name="telefono" type="text" placeholder="0987532156" class="mt-3 block border border-gray-500 hover:border-black w-full p-3 rounded mb-4 text-blue-800 transition duration-300 ease-in-out transform">
                        </label>
                
                        <label class="font-sans uppercase tracking-wide text-gray-500 hover:text-black w-50 text-xl">Genero
                            <input name="genero" type="text" placeholder="1254896352" class="mt-3 block border border-gray-500 hover:border-black w-full p-3 rounded mb-4 text-blue-800 transition duration-300 ease-in-out transform">
                        </label>
                    </div>

                    @if (isset($pedirPass))
                        <div class="md:grid block gap-x-10 grid-rows-1 sm:grid-cols-1 md:grid-cols-1 lg:grid-cols-2 xl:grid-cols-6">

                            <div class="xl:col-start-2 xl:col-span-2">
                                <label for="password_1" class="font-sans ml-2 uppercase tracking-wide text-gray-500 hover:text-black w-50 text-xl">Crear contraseña
                                    <div class="flex py-1">
                                        <input name="password_1" id="password_1" type="password" placeholder="1254896352" class="mt-3 block border border-gray-500 hover:border-black w-full p-3 rounded mb-4 text-blue-800 transition duration-300 ease-in-out transform">
                                        <button type="button" onclick="pass1()" class="flex m-auto py-2 px-10 ml-2 border-0 focus:outline-none rounded-md bg-white text-black hover:text-white hover:bg-yellow-500 transition duration-300 ease-in-out transform">
                                            <div class="w-20 text-center m-auto puntero-eventos-auto">
                                                <input type="button" name="showPass1" id="showPass1" value="Ver" class="bg-transparent" readonly>
                                            </div>
                                        </button>
                                    </div>
                                </label>
                            </div>
                
                            <div class="xl:col-start-4 xl:col-span-2">
                                <label for="password_2" class="font-sans ml-2 uppercase tracking-wide text-gray-500 hover:text-black w-50 text-xl">Confirmar contraseña
                                    <div class="flex py-1">
                                        <input name="password_2" id="password_2" type="password" placeholder="1254896352" class="mt-3 block border border-gray-500 hover:border-black w-full p-3 rounded mb-4 text-blue-800 transition duration-300 ease-in-out transform">
                                        <button type="button" onclick="pass2()" class="flex m-auto py-2 px-10 ml-2 border-0 focus:outline-none rounded-md bg-white text-black hover:text-white hover:bg-yellow-500 transition duration-300 ease-in-out transform">
                                            <div class="w-20 text-center m-auto puntero-eventos-auto">
                                                <input type="button" name="showPass2" id="showPass2" value="Ver" class="bg-transparent" readonly>
                                            </div>
                                        </button>
                                    </div>
                                </label>
                            </div>

                        </div>
                    @endif

                    @if (isset($alert))
                        <div class="text-center my-5 px-5 py-3 text-sm bg-red-100 w-full text-white">
                            {{$alert}}
                        </div>
                    @endif

                    <div class="mt-10 text-center">
                        <input type="submit" value="Guardar" class="w-full md:w-auto outline-none text-xl text-white px-20 py-3 transition duration-500 ease-in-out bg-gray-500 hover:bg-blue-500 transform hover:scale-105">
                    </div>
                
                </form>
            @endauth

        </div>
    </div>

    <script>
        function pass1(){
            var tipo = document.getElementById("password_1");
            if(tipo.type == "password"){
                tipo.type = "text";
                document.getElementById('showPass1').value = "ocultar";
            }else{
                tipo.type = "password";
                document.getElementById('showPass1').value = "ver";
            }
        }
        function pass2(){
            var tipo = document.getElementById("password_2");
            if(tipo.type == "password"){
                tipo.type = "text";
                document.getElementById('showPass2').value = "ocultar";
            }else{
                tipo.type = "password";
                document.getElementById('showPass2').value = "ver";
            }
        }
    </script>

</body>
</html>
