@extends('layouts.app')

@section('content')
    <!-- Perfil de Usuario -->
    <div class="bg-white shadow-sm">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="flex flex-col md:flex-row items-center gap-8 md:gap-12">
                <div class="relative group group">
                    <div class="w-32 h-32 lg:w-48 lg:h-48 rounded-full border-4 border-white shadow-lg overflow-hidden transition-all duration-300 transform group-hover:scale-105 group-hover:border-blue-100 bg-gray-100">
                        <img 
                            src="{{ ($user->image && $user->image !== "" ) ? asset('profile/'.$user->image)  : asset('img/usuario.svg') }}" 
                            alt="{{ $user->username }}"
                            class="w-full h-full object-cover object-center"
                            onerror="this.src='{{ asset('img/usuario.svg') }}'"
                        >
                    </div>
                    <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <svg class="w-12 h-12 text-white drop-shadow-lg" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                </div>
    
                <!-- Información del usuario -->
                <div class="flex-1 space-y-6 text-center md:text-left">
                    <!-- Nombre y Stats -->
                    <div class="space-y-4">
                        <h1 class="text-3xl lg:text-4xl font-bold text-gray-900 tracking-tight">{{ $user->username }}</h1>
                        
                        <!-- Stats -->
                        <div class="flex flex-wrap justify-center md:justify-start gap-4">
                            <div class="bg-gray-50 px-4 py-2 rounded-xl hover:bg-gray-100 transition-colors cursor-default">
                                <span class="block text-xl font-bold text-blue-600">{{ $user->postsCount() }}</span>
                                <span class="text-sm text-gray-600 font-medium">@choice('Publicación|Publicaciones', $user->postsCount())</span>
                            </div>
                
                            <div class="bg-gray-50 px-4 py-2 rounded-xl hover:bg-gray-100 transition-colors cursor-default">
                                <span class="block text-xl font-bold text-gray-900">{{ $user->followersCount() }}</span>
                                <span class="text-sm text-gray-600 font-medium">@choice('Seguidor|Seguidores',$user->followersCount())</span>
                            </div>                    
                
                            <div class="bg-gray-50 px-4 py-2 rounded-xl hover:bg-gray-100 transition-colors cursor-default">
                                <span class="block text-xl font-bold text-gray-900">{{ $user->followingsCount() }}</span>
                                <span class="text-sm text-gray-600 font-medium">Siguiendo</span>
                            </div>
                        </div>
                    </div>
    
                    <!-- Botones de Acción -->
                    <div class="flex flex-wrap justify-center md:justify-start gap-3">
                        @auth
                            @if (!($user->id === auth()->user()->id))
                                @if (!$user->checkFollower(auth()->user()))
                                    <form action="{{ route('follower.follow',$user->username) }}" method="post" class="contents">
                                        @csrf
                                        <button class="px-6 py-2 bg-blue-600 text-white rounded-full hover:bg-blue-700 transition-colors flex items-center gap-2 shadow-sm hover:shadow-md">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                            </svg>
                                            <span>Seguir</span>
                                        </button>
                                    </form>
                                @else
                                    <form action="{{ route('follower.unfollow',$user->username) }}" method="post" class="contents">
                                        @csrf
                                        @method('DELETE')
                                        <button class="px-6 py-2 bg-red-600 text-white rounded-full hover:bg-red-700 transition-colors flex items-center gap-2 shadow-sm hover:shadow-md">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"/>
                                            </svg>
                                            <span>Dejar de seguir</span>
                                        </button>
                                    </form>
                                @endif
                                <button class="px-6 py-2 border border-gray-300 rounded-full hover:bg-gray-50 transition-colors flex items-center gap-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                                    </svg>
                                    <span>Mensaje</span>
                                </button>
                            @endif
                        @endauth
                        
                        @auth
                            @if ($user->id === auth()->user()->id)
                                <a href="{{route('profile.index')}}" class="px-6 py-2 border border-gray-300 rounded-full hover:bg-gray-50 transition-colors flex items-center gap-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                    <span>Configurar perfil</span>
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

