@extends('layouts.app')

@section('content')
    <div 
        class="
        md:flex
        md:justify-center
        mt-10
        ">
        <div class="
            md:w-1/2
            bg-white
            shadow
            p-6
            rounded-2xl
            ">
                <div class="text-center mb-10">
                    <h2 class="text-3xl font-extrabold text-gray-900 mb-2">
                        Editar perfil
                    </h2>
                    <p class="text-gray-500 text-sm">{{ auth()->user()->username }}</p>
                </div>
            <form 
            action="{{ route('profile.store') }}"
            method="POST"
            enctype="multipart/form-data"
            class="
                mt-10
                "
            >
                @csrf

                <div class="mb-5">
                    <label for="username" class="block text-sm font-medium text-gray-700 mb-2">
                        Nombre de usuario:
                    </label>
                    <div class="relative">
                        <input 
                            id="username" 
                            name="username" 
                            type="username" 
                            required
                            value="{{ auth()->user()->username }}"
                            placeholder="juanname"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-indigo-500 @error('email') border-red-500 pr-10 @enderror"
                        >
                        @error('username')
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        @enderror
                    </div>
                    @error('username')
                        <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div >
                    <label for="username" class="block text-sm font-medium text-gray-700 mb-2">
                        Imagen:
                    </label>
                    <div class="relative">
                        <input 
                            id="image" 
                            name="image" 
                            type="file" 
                            accept=".jpg, .jpeg, .png, .webp, .avif"
                            value=""
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg  focus:outline-indigo-500  transition-all "
                        >
                        @error('image')
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        @enderror
                    </div>
                    @error('image')
                        <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <button
                    type="submit"
                    class="mt-10 w-full flex justify-center py-2.5 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors"
                >
                    Editar Perfil
                </button>
            </form>
        </div>
    </div>
@endsection