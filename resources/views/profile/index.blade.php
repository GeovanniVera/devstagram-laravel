@extends('layouts.app')

@section('content')
    <div class="min-h-screen md:flex md:justify-center md:items-start mt-10">
        <div class="md:w-1/2 bg-white shadow-lg p-6 sm:p-8 rounded-2xl mx-4">
            <!-- Encabezado -->
            <div class="text-center mb-8 space-y-2">
                <h2 class="text-3xl font-bold text-gray-900">
                    Editar perfil
                </h2>
                <p class="text-gray-500">@ {{ auth()->user()->username }}</p>
            </div>

            <!-- Mensajes de error -->
            @if ($errors->any())
                <div class="bg-red-50 border-l-4 border-red-400 p-4 mb-6 rounded-lg" role="alert">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-red-800">Hay {{ $errors->count() }} problemas con tu envío</h3>
                            <div class="mt-2 text-sm text-red-700">
                                <ul class="list-disc pl-5 space-y-1">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Formulario -->
            <form 
                action="{{ route('profile.store') }}"
                method="POST"
                enctype="multipart/form-data"
                novalidate
            >
                @csrf

                <!-- Campo Username -->
                <div class="mb-6">
                    <label for="username" class="block text-sm font-medium text-gray-700 mb-2">
                        Nombre de usuario
                    </label>
                    <div class="relative">
                        <input 
                            id="username" 
                            name="username" 
                            type="text" 
                            required
                            value="{{ old('username', auth()->user()->username) }}"
                            placeholder="Ej: juanperez"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('username') border-red-500 pr-10 @enderror"
                            autocomplete="username"
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
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Campo Imagen -->
                <div class="mb-8 flex flex-col">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Imagen de perfil
                    </label>
                    
                    <!-- Previsualización de imagen -->
                    <div class="mt-1 flex flex-col gap-5 items-center ">
                        <div class="relative group ">
                            <img 
                                src="{{ auth()->user()->image ? asset('profile') . '/' . auth()->user()->image : asset('img/user.png') }}" 
                                alt="Imagen actual de perfil" 
                                class="w-30 h-30 rounded-full object-cover border-2 border-gray-200 group-hover:opacity-75 transition-opacity"
                            >
                            <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center rounded-full opacity-0 group-hover:opacity-100 transition-opacity">
                                <span class="text-white text-xs font-medium">Actual</span>
                            </div>
                        </div>
                        
                        <div class="w-full">
                            <div class="relative">
                                <input 
                                    id="image" 
                                    name="image" 
                                    type="file" 
                                    accept=".jpg, .jpeg, .png, .webp, .avif"
                                    class="opacity-0 absolute inset-0 w-full h-full cursor-pointer"
                                    onchange="previewImage(event)"
                                >
                                <div class="w-full px-4 py-10 border-2 border-dashed border-gray-300 rounded-lg text-center hover:border-gray-400 focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition-all">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    <div class="mt-2 text-sm text-gray-600">
                                        <span class="font-medium text-indigo-600 hover:text-indigo-500">Haz clic para subir</span>
                                        <p class="text-xs text-gray-500 mt-1">Formatos: JPG, PNG, WEBP, AVIF</p>
                                    </div>
                                </div>
                            </div>
                            @error('image')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Botón de submit -->
                <button
                    type="submit"
                    class="w-full py-3 px-4 inline-flex justify-center items-center gap-2 rounded-md border border-transparent font-semibold bg-indigo-600 text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-all"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Guardar cambios
                </button>
            </form>
        </div>
    </div>

    <script>
        function previewImage(event) {
            const reader = new FileReader();
            const previewContainer = event.target.closest('.flex-1');
            const preview = document.createElement('img');
            preview.className = 'w-20 h-20 rounded-full object-cover border-2 border-indigo-200';
            
            reader.onload = function(e) {
                // Remover previsualizaciones anteriores
                previewContainer.querySelectorAll('img').forEach(img => img.remove());
                
                preview.src = e.target.result;
                event.target.previousElementSibling.insertBefore(preview, event.target.previousElementSibling.firstChild);
            };
            
            if(event.target.files[0]) {
                reader.readAsDataURL(event.target.files[0]);
            }
        }
    </script>
@endsection