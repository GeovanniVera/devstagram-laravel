@extends('layouts.app')


@section('content')
    <div class="md:flex md:justify-center md:gap-4 md:items-center">
        <div 
        class="md:w-1/2 p-3 lg:w-6/12">
            <img src="{{ asset('img/registrar.jpg') }}" alt="imagen registro"></img>
        </div>
        <div class="md:w-1/2 lg:w-4/12 bg-white shadow-xl">
            <form action="" class="p-5">

                <div>
                    <h2 class="font-black text-center text-3xl mb-10">
                        Registra tu cuenta
                    </h2>
                </div>
                
                <div 
                class="mb-5">
                    <label 
                        for="name" 
                        class="mb-2 
                        block uppercase 
                        text-gray-500 
                        font-bold">
                        Nombre:
                    </label>
                    <input 
                        type="text"
                        name="name"
                        id="name"
                        class="
                        border
                        border-gray-500
                        p-3
                        w-full"
                        placeholder="Geovanni Benjamin Vera Balcazar">
                </div>
                <div 
                class="mb-5">
                    <label 
                        for="username" 
                        class="mb-2 
                        block uppercase 
                        text-gray-500 
                        font-bold">
                        Nombre de usuario:
                    </label>
                    <input 
                        type="text"
                        name="username"
                        id="username"
                        placeholder="Geovanni Vera"
                        class="
                        border
                        border-gray-500
                        p-3
                        w-full"
                        >
                </div>
                <div 
                class="mb-5">
                    <label 
                        for="email" 
                        class="mb-2 
                        block uppercase 
                        text-gray-500 
                        font-bold">
                        Correo Electronico:
                    </label>
                    <input 
                        type="email"
                        name="email"
                        id="email"
                        placeholder="geovannivera@gmail.com"
                        class="
                        border
                        border-gray-500
                        p-3
                        w-full">
                </div>
                <div 
                class="mb-5">
                    <label 
                        for="password" 
                        class="mb-2 
                        block uppercase 
                        text-gray-500 
                        font-bold">
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
                        p-3
                        w-full">
                </div>
                <div 
                class="mb-5">
                    <label 
                        for="password_confirmation" 
                        class="mb-2 
                        block uppercase 
                        text-gray-500 
                        font-bold">
                        Repite tu contraseña:
                    </label>
                    <input 
                        type="password"
                        name="password_confirmation"
                        id="password_confirmation"
                        placeholder="YouPassword123@"
                        class="
                        border
                        border-gray-500
                        p-3
                        w-full">
                </div>
                <div class="mb-5">
                    <input 
                        type="submit"
                        value="Crear Cuenta"
                        class="
                        border
                        border-gray-500
                        bg-indigo-700
                        hover:bg-indigo-900
                        transition-colors
                        cursor-pointer
                        text-amber-50
                        rounded-md
                        p-3
                        w-full">
                </div>
            </form>
        </div>
    </div>

@endsection