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
    <header class="p-5  bg-white shadow">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-3xl font-black">
                Devstagram
            </h1>

            @auth
            
            <div class="py-4 bg-white border-b border-gray-100">
                <nav class="max-w-6xl mx-auto px-4">
                    <div class="flex flex-wrap items-center gap-3 sm:gap-4">
                        <!-- Muro -->
                        <a
                            href="{{ route('posts.index', auth()->user()->username) }}"
                            class="group flex items-center gap-2 px-3 py-2 sm:px-4 sm:py-2.5 bg-white rounded-lg transition-all duration-200 hover:bg-gray-50 hover:shadow-sm border border-gray-200 hover:border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-1"
                        >
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                          </svg>
                          
                            <span class="text-sm font-medium text-gray-700 group-hover:text-indigo-700 transition-colors hidden sm:block">Muro</span>
                        </a>
            
                        <!-- Crear Post -->
                        <a
                            href="{{ route('posts.create')}}"
                            class="group flex items-center gap-2 px-4 py-2.5 bg-indigo-600 rounded-lg transition-all duration-200 hover:bg-indigo-700 hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-1"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 10.5v6m3-3H9m4.06-7.19-2.12-2.12a1.5 1.5 0 0 0-1.061-.44H4.5A2.25 2.25 0 0 0 2.25 6v12a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9a2.25 2.25 0 0 0-2.25-2.25h-5.379a1.5 1.5 0 0 1-1.06-.44Z" />
                            </svg>
                          
                            <span class="text-sm font-medium text-white hidden sm:block">Nueva Publicación</span>
                        </a>
            
                        <!-- Separador -->
                        <div class="hidden sm:block h-6 w-px bg-gray-200 mx-2"></div>
            
                        <!-- Cerrar Sesión -->
                        <form method="POST" action="{{ route('logout') }}" class="inline-block">
                            @csrf
                            <button
                                type="submit"
                                class="group flex items-center gap-2 px-3 py-2 sm:px-4 sm:py-2.5 bg-white rounded-lg transition-all duration-200 hover:bg-red-50 hover:shadow-sm border border-gray-200 hover:border-red-200 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-1"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15M12 9l-3 3m0 0 3 3m-3-3h12.75" />
                                </svg>
                              
                                <span class="cursor-pointer text-sm font-medium text-gray-700 group-hover:text-red-700 transition-colors hidden sm:block">Cerrar Sesión</span>
                            </button>
                        </form>
                    </div>
                </nav>
            </div>
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

    <main class="container mx-auto ">
        
        @yield('content')
    </main>
   
    <footer class="text-center p-5 text-gray-500 font-bold mt-5">
        Devstagram - todos los derechos reservados  {{ now()->year }}
    </footer>

</body>

</html>