<!DOCTYPE html>
<html lang="{{ str_replace('_','-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Devstagram</title>
    @stack('styles')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="bg-gray-100" x-data="{ mobileMenuOpen: false }">
    @auth
    <!-- Layout para usuarios autenticados -->
    <div class="min-h-screen md:flex">
        <!-- Sidebar para desktop -->
        <aside class="hidden md:block md:w-70 fixed left-0 top-0 h-screen bg-white shadow-lg p-4 transition-all duration-300 z-50">
            <div class="flex flex-col h-full">
                <!-- Logo -->
                <a href="{{ route('home') }}" class="text-2xl font-bold text-gray-800 mb-8 px-2 cursor-pointer">Devstagram</a>
                
                <!-- Menú navegación -->
                <nav class="flex-1 space-y-2">
                    <a href="{{ route('home')}}" 
                       class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-indigo-50 text-gray-600 hover:text-indigo-700 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                        </svg>
                        <span class="text-sm font-medium">Inicio</span>
                    </a>

                    <a href="{{ route('posts.index', auth()->user()->username) }}" 
                       class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-indigo-50 text-gray-600 hover:text-indigo-700 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        </svg>
                        <span class="text-sm font-medium">Muro</span>
                    </a>

                    <a href="{{ route('posts.create')}}" 
                       class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-indigo-50 text-gray-600 hover:text-indigo-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 10.5v6m3-3H9m4.06-7.19-2.12-2.12a1.5 1.5 0 0 0-1.061-.44H4.5A2.25 2.25 0 0 0 2.25 6v12a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9a2.25 2.25 0 0 0-2.25-2.25h-5.379a1.5 1.5 0 0 1-1.06-.44Z" />
                        </svg>
                        <span class="text-sm font-medium">Nueva Publicación</span>
                    </a>
                </nav>

                <!-- Cerrar Sesión -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" 
                            class="w-full flex items-center gap-3 px-4 py-3 mt-4 rounded-lg text-gray-600 hover:bg-red-50 hover:text-red-700 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15M12 9l-3 3m0 0 3 3m-3-3h12.75" />
                        </svg>
                        <span class="text-sm font-medium">Cerrar Sesión</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- Contenido principal -->
        <div class="md:ml-64 flex-1">
            <!-- Navbar móvil -->
            <nav class="md:hidden bg-white shadow-sm p-4 flex justify-between items-center">
                <h2 class="text-xl font-bold text-gray-800">Devstagram</h2>
                <button @click="mobileMenuOpen = !mobileMenuOpen" class="p-2 rounded-lg hover:bg-gray-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </nav>

            <!-- Menú móvil -->
            <div x-show="mobileMenuOpen" @click.away="mobileMenuOpen = false" 
                 class="md:hidden fixed inset-0 z-50 bg-white">
                <div class="p-4">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-xl font-bold text-gray-800">Menú</h2>
                        <button @click="mobileMenuOpen = false" class="p-2 rounded-lg hover:bg-gray-100">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    
                    <nav class="space-y-4">

                        <a href="{{ route('home')}}" 
                           class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-indigo-50 text-gray-600 hover:text-indigo-700">
                           <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                          </svg>
                          
                            <span class="text-sm">Inicio</span>
                        </a>

                        <a href="{{ route('posts.index', auth()->user()->username) }}" 
                           class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-indigo-50 text-gray-600 hover:text-indigo-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>
                            <span class="text-sm">Muro</span>
                        </a>

                        <a href="{{ route('posts.create')}}" 
                           class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-indigo-50 text-gray-600 hover:text-indigo-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 10.5v6m3-3H9m4.06-7.19-2.12-2.12a1.5 1.5 0 0 0-1.061-.44H4.5A2.25 2.25 0 0 0 2.25 6v12a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9a2.25 2.25 0 0 0-2.25-2.25h-5.379a1.5 1.5 0 0 1-1.06-.44Z" />
                            </svg>
                            <span class="text-sm">Nueva Publicación</span>
                        </a>

                        

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" 
                                    class="w-full flex items-center gap-3 px-4 py-3 rounded-lg text-gray-600 hover:bg-red-50 hover:text-red-700">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15M12 9l-3 3m0 0 3 3m-3-3h12.75" />
                                </svg>
                                <span class="text-sm">Cerrar Sesión</span>
                            </button>
                        </form>
                    </nav>
                </div>
            </div>

            <!-- Contenido -->
            <main class="p-4 md:p-8">
                @yield('content')
            </main>
            
            <footer class="text-center p-5 text-gray-500 font-bold mt-5">
                Devstagram - Todos los derechos reservados {{ now()->year }}
            </footer>
        </div>
    </div>
    @endauth
    @guest
    <header class="p-5  bg-white shadow">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-3xl font-black">
                Devstagram
            </h1>

            
            <nav class="flex gap-8 items-center">
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
        
        </div>
    </header>
        <!-- Contenido -->
        <main class="p-4 md:p-8">
            @yield('content')
        </main>
        
        <footer class="text-center p-5 text-gray-500 font-bold mt-5">
            Devstagram - Todos los derechos reservados {{ now()->year }}
        </footer>
    @endguest

    @livewireScripts
</body>
</html>