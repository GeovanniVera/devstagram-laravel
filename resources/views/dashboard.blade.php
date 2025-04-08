@extends('layouts.app')

@section('content')
    <!-- Perfil de Usuario -->
<div class="bg-white shadow-sm mt-5">
    <div class="max-w-6xl mx-auto px-4 py-8">
        <div class="flex flex-col md:flex-row items-center gap-8">
            <!-- Avatar -->
            <div class="w-32 h-32 lg:w-48 lg:h-48 relative group">
                <img 
                    src="{{ asset('profile/'.$user->image) }}" 
                    alt="{{ $user->username }}" 
                    class="w-full h-full rounded-full border-4 border-white shadow-lg object-cover hover:border-blue-100 transition-all duration-300">
            </div>
            
            <!-- Información del usuario -->
            <div class="flex-1 space-y-4 text-center md:text-left">
                <h1 class="text-3xl lg:text-4xl font-bold text-gray-800 mb-2">{{ $user->username }}</h1>
                
                <!-- Stats -->
                <div class="flex flex-wrap justify-center md:justify-start gap-6">
                    <div class="bg-gray-50 px-4 py-2 rounded-lg hover:bg-gray-100 transition-colors">
                        <span class="block text-xl font-bold text-blue-600 text-center">{{ $user->posts->count() }}</span>
                        <span class="text-sm text-gray-600">Publicaciones</span>
                    </div>
                    <button class="bg-gray-50 px-4 py-2 rounded-lg hover:bg-gray-100 transition-colors">
                        <span class="block text-xl font-bold text-gray-800">0</span>
                        <span class="text-sm text-gray-600">Seguidores</span>
                    </button>
                    <button class="bg-gray-50 px-4 py-2 rounded-lg hover:bg-gray-100 transition-colors">
                        <span class="block text-xl font-bold text-gray-800">0</span>
                        <span class="text-sm text-gray-600">Siguiendo</span>
                    </button>
                </div>
                
                <!-- Botones de acción -->
                <div class="flex gap-4 justify-center md:justify-start">
                    <button class="px-6 py-2 bg-blue-500 text-white rounded-full hover:bg-blue-600 transition-colors flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Seguir
                    </button>
                    <button class="px-6 py-2 border border-gray-300 rounded-full hover:bg-gray-50 transition-colors">
                        Mensaje
                    </button>
                    @auth
                        @if ($user->id === auth()->user()->id)
                            <a 
                                href="{{route('profile.index')}}"
                                class="px-6 py-2 border border-gray-300 rounded-full hover:bg-gray-50 transition-colors">
                                Configura tu perfil
                            </a>
                        @endif
                    @endauth
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Publicaciones -->
<section class="max-w-6xl mx-auto px-4 py-8">
    <h2 class="text-3xl font-bold text-gray-800 mb-8 text-center">Publicaciones</h2>
    
    @if($posts->isEmpty())
        <div class="text-center py-12 space-y-4">
            <div class="inline-block p-6 bg-gray-100 rounded-full">
                <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <p class="text-gray-600 text-lg">Aún no hay publicaciones</p>
        </div>
    @else
        <div class="grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @foreach($posts as $post)
                <a 
                    href="{{ route('posts.show', ['user' => $user->username, 'post' => $post]) }}" 
                    class="group relative block overflow-hidden rounded-lg aspect-square hover:shadow-lg transition-shadow">
                    <img 
                        src="{{ asset('uploads') . '/' . $post->image }}" 
                        alt="{{ $post->title }}"
                        class="w-full h-full object-cover transform transition-transform duration-300 group-hover:scale-105">
                    
                    <!-- Hover overlay -->
                    <div class="absolute inset-0  bg-opacity-0 group-hover:bg-opacity-40 transition-opacity flex items-center justify-center">
                        <div class="opacity-0 group-hover:opacity-100 transition-opacity text-white space-y-2 text-center">
                            <svg class="w-8 h-8 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                            </svg>
                            <span class="font-bold block">{{ $post->likes_count }}</span>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
        
        <!-- Paginación -->
        <div class="mt-8">
            {{ $posts->links('pagination::tailwind') }}
        </div>
    @endif
</section>
@endsection

