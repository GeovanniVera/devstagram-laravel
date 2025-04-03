<!DOCTYPE html>
<html lang="{{ str_replace('_','-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Devstagram</title>
    @stack('styles')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">
    <header class="p-5 border-b bg-white shadow">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-3xl font-black">
                Devstagram
            </h1>

            @auth
            
            <nav class="flex gap-2 items-center">
                <a 
                    href="{{ route('posts.index',auth()->user()->username) }}"
                    class="
                    flex 
                    items-center 
                    gap-2 
                    bg-white 
                    p-2 
                    text-gray-600 
                    rounded 
                    text-sm 
                    uppercase 
                    font-bold 
                    border
                    hover:border-indigo-600
                    cursor-pointer
                    transition-all 
                    ">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    </svg>                        
                    Muro
                </a>
                <a 
                    href="{{ route('posts.create')}}"
                    class="
                    flex 
                    items-center 
                    gap-2 
                    bg-white 
                    p-2 
                    text-gray-600 
                    rounded 
                    text-sm 
                    uppercase 
                    font-bold 
                    border
                    hover:border-indigo-600
                    cursor-pointer
                    transition-all 
                    ">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m3.75 9v6m3-3H9m1.5-12H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                      </svg>
                      
                    Crear Post
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button 
                        type="submit" 
                        class="
                        flex 
                    items-center 
                    gap-2 
                    bg-white 
                    p-2 
                    text-gray-600 
                    rounded 
                    text-sm 
                    uppercase 
                    font-bold 
                    border
                    hover:border-indigo-600
                    cursor-pointer
                    transition-all
                        ">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15M12 9l3 3m0 0-3 3m3-3H2.25" />
                          </svg>
                          
                        Cerrar Sesion
                    </button>
                </form>
                
            </nav>
            @endauth

            @guest
            <nav class="flex gap-2 items-center">
                <a 
                    href="{{ route('login') }}" 
                    class="font-bold uppercase text-gray-600 text-sm ">
                    Inicia Sesion
                </a>
                <a 
                    href="{{ route('register') }}" 
                    class="font-bold uppercase text-gray-600 text-sm ">
                    Registrate
                </a>
            </nav>
            @endguest
        </div>
    </header>

    <main class="container mx-auto mt-10">
        <h2 class="font-black text-center text-3xl mb-10">
            @yield('title')
        </h2>
        @yield('content')
    </main>
   
    <footer class="text-center p-5 text-gray-500 font-bold mt-5">
        Devstagram - todos los derechos reservados  {{ now()->year }}
    </footer>

</body>

</html>