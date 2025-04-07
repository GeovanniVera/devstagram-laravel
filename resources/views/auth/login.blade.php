@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center  py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-6xl w-full flex flex-col md:flex-row items-center justify-between gap-8 bg-white rounded-2xl shadow-2xl overflow-hidden">
        <!-- Imagen -->
        <div class="md:w-1/2 h-64 md:h-auto relative px-5">
            <img src="{{ asset('img/login.jpg') }}" alt="Imagen inicio de sesión" 
                 class="w-full h-full object-cover object-center rounded-2xl">
        </div>

        <!-- Formulario -->
        <div class="w-full md:w-1/2 p-8 lg:p-12 space-y-8">
            <div class="text-center">
                <h2 class="text-4xl font-extrabold text-gray-900 mb-2 tracking-tight">
                    Bienvenido de nuevo
                </h2>
                <p class="text-gray-500">Ingresa tus credenciales para continuar</p>
            </div>

            @if (session('message'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('message') }}</span>
                </div>
            @endif

            <form class="mt-8 space-y-6" action="/login" method="POST">
                @csrf
                
                <div class="space-y-6">
                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                            Correo electrónico
                        </label>
                        <div class="relative">
                            <input 
                                id="email" 
                                name="email" 
                                type="email" 
                                autocomplete="email" 
                                required
                                autofocus
                                value="{{ old('email') }}"
                                placeholder="ejemplo@correo.com"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-600 focus:border-transparent transition-all @error('email') border-red-500 @enderror"
                            >
                            @error('email')
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                            @enderror
                        </div>
                        @error('email')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Contraseña -->
<div>
    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
        Contraseña
    </label>
    <div class="relative" x-data="{ showPassword: false }">
        <input 
            id="password" 
            name="password" 
            :type="showPassword ? 'text' : 'password'" 
            required
            placeholder="••••••••"
            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all @error('password') border-red-500 pr-10 @enderror"
        >
        <button 
            type="button" 
            @click="showPassword = !showPassword"
            class="absolute inset-y-0 right-0 pr-3 flex items-center"
        >
            <svg 
                class="h-5 w-5 text-gray-400 hover:text-indigo-500 transition-colors" 
                :class="{ 'text-indigo-500': showPassword }"
                fill="none" 
                stroke="currentColor" 
                stroke-width="1.5" 
                viewBox="0 0 24 24"
            >
                <path 
                    x-show="!showPassword"
                    stroke-linecap="round" 
                    stroke-linejoin="round" 
                    d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"
                />
                <path 
                    x-show="showPassword"
                    stroke-linecap="round" 
                    stroke-linejoin="round" 
                    d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88"
                />
                <path 
                    stroke-linecap="round" 
                    stroke-linejoin="round" 
                    d="M9.879 9.879l-3.27-3.27m8.518 8.518l3.27 3.27" 
                    x-show="showPassword"
                />
            </svg>
        </button>
        @error('password')
        <div class="absolute inset-y-0 right-8 pr-3 flex items-center pointer-events-none">
            <svg class="h-5 w-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
            </svg>
        </div>
        @enderror
    </div>
    @error('password')
        <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>

                    <!-- Recordar sesión -->
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input 
                                id="remember" 
                                name="remember" 
                                type="checkbox" 
                                class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded"
                            >
                            <label for="remember" class="ml-2 block text-sm text-gray-900">
                                Mantener sesión activa
                            </label>
                        </div>
                        <div class="text-sm">
                            <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500">
                                ¿Olvidaste tu contraseña?
                            </a>
                        </div>
                    </div>

                    <!-- Botón de submit -->
                    <button
                        type="submit"
                        class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors"
                    >
                        Iniciar sesión
                    </button>

                    <!-- Enlace a registro -->
                    <div class="text-center text-sm">
                        <span class="text-gray-600">¿No tienes cuenta? </span>
                        <a href="{{ route('register') }}" class="font-semibold text-indigo-600 hover:text-indigo-500">
                            Crear cuenta
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection