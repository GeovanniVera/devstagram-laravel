@extends('layouts.app')

@section('content')
    <div class="md:flex md:justify-center md:gap-4 md:items-center">
        <div 
        class="md:w-1/2 lg:w-5/12 p-3">
            <img src="{{ asset('img/login.jpg') }}" alt="imagen inicio de sesion"></img>
        </div>
        <div class="md:w-1/2 lg:w-4/12 bg-white p-6 shadow-xl">
            <form action="">

                <div>
                    <h2 class="font-black text-center text-3xl mb-10">
                        Inicia Sesion
                    </h2>
                </div>
                @csrf;
                <div class="mb-8">
                    <label 
                        for="email" 
                        class="mb-2 
                        block uppercase 
                        text-gray-500 
                        font-bold
                        @error('email')
                            text-red-600
                        @enderror
                        ">
                        Correo Electronico:
                    </label>
                    <input 
                        type="email"
                        name="email"
                        id="email"
                        placeholder="geovannivera@gmail.com"
                        class="
                        border
                        focus:outline-indigo-600
                        border-gray-500
                        p-3
                        w-full
                        @error('email')
                            border-red-600
                        @enderror
                        ">
                    @error('email')
                        <p class="text-red-600 mt-3">{{ $message }}</p>
                    @enderror
                </div>
                <div 
                class="mb-8">
                    <label 
                        for="password" 
                        class="mb-2 
                        block uppercase 
                        text-gray-500 
                        font-bold
                        @error('email')
                            text-red-600
                        @enderror
                        ">
                        Contraseña:
                    </label>
                    <input 
                        type="password"
                        name="password"
                        id="password"
                        placeholder="YouPassword123@"
                        class="
                        border
                        border-gray-500
                        focus:outline-indigo-600
                        p-3
                        w-full
                        @error('email')
                            border-red-600
                        @enderror
                        ">
                    @error('password')
                        <p class="text-red-600 mt-3">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-5">
                    <input 
                        type="submit"
                        value="Iniciar Sesiòn"
                        class="
                        border
                        border-gray-500
                        bg-indigo-700
                        hover:bg-indigo-900
                        transition-colors
                        cursor-pointer
                        text-amber-50
                        p-3
                        rounded-md
                        w-full">
                </div>
            </form>
        </div>
    </div>

@endsection