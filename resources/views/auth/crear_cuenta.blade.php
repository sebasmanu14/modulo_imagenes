<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Crear Cuenta</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/app.css')}}">
        
    </head>
<body class="container bg-grey-100 ">
	<div class="bg-grey-lighter min-h-screen flex flex-col">
        <div class="container mt-16 px-7 py-20 rounded max-w-lg bg-white shadow-md">

            <img src="https://www.gobiernoabierto.ec/wp-content/uploads/2020/01/Logo-Esquel-color.png" alt="logo" width="250" height="250">
            <h1 class="mt-16 mb-6 text-4xl uppercase text-center text-black font-sans">Crear cuenta</h1>
           
            @if ($errors->all())
                <ul class="text-center  bg-red-100 p-5 text-white my-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif

            @if (isset($alert))
                <div class="text-center my-5 px-5 py-3 text-sm bg-red-100 w-full text-white">
                    {{$alert}}
                </div>
            @endif

            <form action="{{ route('createUser') }}" method="PUT" class="rounded max-w-lg">
                @csrf
                <label class="ont-sans ml-2 uppercase tracking-wide text-gray-500 hover:text-black text-xl" for="email">Email 
                    <input type="text" class="mt-3 block border border-gray-500 hover:border-black w-full p-3 rounded mb-4 text-blue-800 transition duration-300 ease-in-out transform"
                        name="email" placeholder="Email"/>
                </label>
                

                <label class="ont-sans ml-2 uppercase tracking-wide text-gray-500 hover:text-black w-50 text-xl" for="password">Contraseña 
                    <div class="flex py-1">
                        <input 
                            type="password"
                            class="mt-4 border border-gray-500 hover:border-black w-4/5 p-3 rounded mb-4 text-blue-800 transition duration-300 ease-in-out transform"
                            id="password_1" name="password_1"
                            placeholder="Contraseña"/>
                        <button type="button" onclick="pass1()" class="flex m-auto py-2 px-10 ml-2 border-0 focus:outline-none rounded-md bg-white text-black hover:text-white hover:bg-yellow-500 transition duration-300 ease-in-out transform">
                            <div class="w-20 text-center m-auto puntero-eventos-auto">
                                <input type="button" name="showPass" id="showPass1" value="Ver" class="bg-transparent" readonly>
                            </div>
                        </button>
                    </div>
                </label>

                
                <label class="ont-sans ml-2 uppercase tracking-wide text-gray-500 hover:text-black w-50 text-xl" for="password">Confirmar contraseña
                    <div class="flex py-1">
                        <input 
                            type="password"
                            class="mt-4 block border border-gray-500 hover:border-black w-4/5 p-3 rounded mb-4 text-blue-800 transition duration-300 ease-in-out transform"
                            id="password_2" name="password_2"
                            placeholder="Contraseña"/>   
                        <button type="button" onclick="pass2()" class="flex m-auto py-2 px-10 ml-2 border-0 focus:outline-none rounded-md bg-white text-black hover:text-white hover:bg-yellow-500 transition duration-300 ease-in-out transform">
                            <div class="w-20 text-center m-auto">
                                <input type="button" name="showPass" id="showPass2" value="Ver" class="bg-transparent">
                            </div>
                        </button>
                    </div>
                </label>

                <input type="submit" value="Crear" class="w-full outline-none text-base text-white px-10 py-3 transition duration-500 ease-in-out bg-gray-500 hover:bg-blue-500 transform hover:scale-105">
                
                <div class="w-32 m-auto">
                    <a href="login" class="no-underline text-black text-center">
                        <p class="py-5 w-full">Iniciar sesión</p>
                    </a>
                </div>

            </form>

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
