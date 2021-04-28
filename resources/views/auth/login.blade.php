<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Login</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/app.css')}}">
    
    </head>
<body class="bg-grey-100">

    <div class="min-h-screen flex flex-col">
        
        @if (session('info'))
            <div class="bg-red-100 p-5 text-white">
                {{session('info')}}
            </div>
        @endif
        
        <div class="container mt-16 px-7 py-20 rounded max-w-lg bg-white shadow-md">
            
            <form action="{{ route('checkUser') }}" method="PUT" class="w-full">
                @csrf
                <img src="https://www.gobiernoabierto.ec/wp-content/uploads/2020/01/Logo-Esquel-color.png" alt="logo" width="250" height="250">
                <h1 class="mt-16 mb-6 text-4xl uppercase text-center text-black font-sans">Iniciar sesión</h1>
                
                @if ($errors->all())
                    <ul class="bg-red-100 p-5 text-white my-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif

                @if (isset($alert))
                    <div class="my-5 px-5 py-3 text-sm text-center bg-red-100 w-full text-white">
                        {{$alert}}
                    </div>
                @endif
              
                <label class="font-sans ml-2 uppercase tracking-wide text-gray-500 hover:text-black w-50 text-xl transition duration-300 ease-in-out transform"for="usuario">Email
                    <input name="email" type="text"class="mt-3 block border border-gray-500 hover:border-black w-full p-3 rounded mb-4 text-blue-800 transition duration-300 ease-in-out transform" placeholder="ejemplo@ejemplo.com"/>
                </label>

                <label class="font-sans ml-2 uppercase tracking-wide text-gray-500 hover:text-black w-50 text-xl" for="contraseña">Contraseña
                    <div class="flex py-1 leading-normal">
                        <input id="password" name="password" type="password" class="mt-4 block border border-gray-500 hover:border-black w-full p-3 rounded mb-4 text-blue-800 transition duration-300 ease-in-out transform" placeholder="contraseña"/>     
                        <button type="button" onclick="pass()" class="flex m-auto py-2 px-10 ml-2 border-0 focus:outline-none rounded-md bg-white text-black hover:text-white hover:bg-yellow-500 transition duration-300 ease-in-out transform">
                            <div class="w-20 text-center m-auto">
                                <input type="button" name="showPass" id="showPass" value="Ver" class="bg-transparent">
                            </div>
                        </button>
                    </div>
                </label>

                <div class="grid grid-row-2 gap-1">
                    <div class="">
                        <input id="submit" type="submit" value="Ingresar" class="w-full outline-none text-base text-white px-10 py-3 transition duration-500 ease-in-out bg-gray-500 hover:bg-blue-500 transform hover:scale-105">
                    </div>
                   
                    <div class="w-32 m-auto">
                        <a href="{{ url('crear_cuenta') }}" class="no-underline text-black text-center">
                            <p class="py-5 w-full">Crear cuenta</p>
                        </a>
                    </div>
                
                </div>

            </form>

            <div class="mt-0 text-center w-full">
                <a class="grid grid-cols-8 grid-rows-1" href="{{ url('login/facebook') }}">
                    <div class="py-2 col-start-1 col-end-2">
                        <img class="transition duration-500 ease-in-out transform hover:scale-110 w-ful h-8" src="https://cdn.icon-icons.com/icons2/2108/PNG/512/facebook_icon_130940.png"/>
                    </div>
                    <p class="leading-loose bg-blue-100 text-white py-2 rounded col-start-2 col-end-10 transition duration-500 ease-in-out hover:bg-blue-600 transform hover:scale-105">Login with facebook</p>
                </a>
            </div>

            <div class="mt-4 text-center w-full">
                <a class="grid grid-cols-8 grid-rows-1" href="{{ url('login/google') }}">
                    <div class="py-2 col-start-1 col-end-2">
                        <img class="transition duration-500 ease-in-out transform hover:scale-110  w-ful h-8" src="https://upload.wikimedia.org/wikipedia/commons/5/53/Google_%22G%22_Logo.svg"/>
                    </div>
                    <p class="leading-loose bg-red-100 text-white py-2 rounded col-start-2 col-end-10 transition duration-500 ease-in-out hover:bg-red-600 transform hover:scale-105">Login with google</p>
                </a>
            </div>
        </div>
     </div>
    
     <script>
        function pass(){
            var tipo = document.getElementById("password");
            if(tipo.type == "password"){
                tipo.type = "text";
                document.getElementById('showPass').value = "ocultar";
            }else{
                tipo.type = "password";
                document.getElementById('showPass').value = "ver";
            }
        }
    </script>

</body>
</html>