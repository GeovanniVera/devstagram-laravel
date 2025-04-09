@extends('layouts.app')

@section('content')
    <div class="container w-full md:w-3/6 mx-auto flex flex-col p-4 md:p-10 gap-5">
        <!-- Descripción del post -->
        <article class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
            <div class="relative overflow-hidden">
                <img 
                    src="{{ asset('uploads') . '/' . $post->image }}" 
                    alt="Post Image {{ $post->title }}" 
                    class="w-full aspect-video object-cover transform transition-transform duration-300 hover:scale-105">
            </div>
            
            <div class="p-4 md:p-6">
                <div class="flex items-center gap-3 mb-4">
                    <div class="flex-1 min-w-0">
                        <a 
                            href="{{ route('posts.index',$post->user) }}"
                            class="block font-bold text-gray-800 hover:text-indigo-600 transition-colors truncate">
                            {{ $post->user->username }}
                        </a>
                        <p class="text-xs text-gray-500 mt-1">
                            <time datetime="{{ $post->created_at->format('Y-m-d') }}">
                                {{ $post->created_at->format('M d, Y') }}
                            </time> 
                            • {{ $post->created_at->diffForHumans() }}
                        </p>
                    </div>
                </div>
    
                <p class="text-gray-700 leading-relaxed mb-4 whitespace-pre-line">
                    {{ $post->description }}
                </p>
    
                <!-- Botones de interacción -->
                <div class="flex flex-wrap items-center gap-4 text-gray-500">
                    @if (!$post->checkLike(auth()->user()))
                        <form action="{{ route('posts.likes.store',$post) }}" method="POST">
                            @csrf
                            <button class="flex items-center gap-1 hover:text-red-500 transition-colors group">
                                <svg class="w-6 h-6 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                </svg>
                                <span class="text-sm">{{ $post->likes()->count() }}</span>
                            </button>
                        </form>
                    @else
                        <form method="POST" action="{{ route('posts.likes.destroy',$post) }}" >
                            @method('DELETE')
                            @csrf
                            <button class="flex items-center gap-1 text-red-500 transition-colors group">
                                <svg class="w-6 h-6 group-hover:scale-110 transition-transform" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                                </svg>
                                <span class="text-sm">{{ $post->likes()->count() }}</span>
                            </button>
                        </form>
                    @endif
                    
                    <div class="flex items-center gap-4">
                        <button class="flex items-center gap-1 text-blue-600 hover:text-blue-500 transition-colors group">
                            <svg class="w-6 h-6 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                            </svg>
                            <span class="text-sm">{{$post->comments->count()}}</span>
                        </button>
                        
                        @auth
                            @if ($post->user_id == auth()->user()->id)
                                <form method="POST" action="{{ route('posts.destroy', $post) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="flex items-center gap-1 hover:text-red-600 transition-colors group">
                                        <svg class="w-6 h-6 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                        </svg>
                                        <span class="text-sm hidden md:inline">Eliminar</span>
                                    </button>
                                </form>
                            @endif
                        @endauth
                    </div>
                </div>
            </div>
        </article>
    
        <!-- Caja de comentarios -->
        <div class="bg-white rounded-xl shadow-lg p-4 md:p-6">
            <h3 class="font-semibold text-lg mb-4">Comentarios ({{ $post->comments->count() }})</h3>
            
            <!-- Formulario de comentarios -->
            <form class="mb-6" novalidate method="POST" action="{{ route('comments.store', ['post' => $post]) }}">
                @csrf
                <div class="flex flex-col md:flex-row gap-3">
                    <div class="flex-1 relative">
                        <input 
                            name="comment"
                            type="text" 
                            value="{{ old('comment') }}"
                            placeholder="Escribe un comentario..."
                            class="w-full rounded-full px-4 py-2 border border-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('comment') border-red-500 @enderror"
                            aria-label="Escribe un comentario"
                        >
                        @error('comment')
                            <p class="text-red-500 text-sm mt-1 ml-3">{{ $message }}</p>
                        @enderror
                    </div>
                    <button 
                        type="submit"
                        class="px-6 py-2 bg-blue-500 text-white rounded-full hover:bg-blue-600 transition-colors shadow-md hover:shadow-sm"
                    >
                        Publicar
                    </button>
                </div>
            </form>

            <!-- Lista de comentarios -->
            <div class="space-y-4">
                @forelse($post->comments as $comment)
                    <div class="flex gap-3">
                        <img 
                            src="https://i.pravatar.cc/40?u={{ $comment->user->email }}" 
                            alt="Avatar de {{ $comment->user->username }}" 
                            class="h-10 w-10 rounded-full flex-shrink-0">
                        <div class="flex-1 min-w-0">
                            <div class="bg-gray-50 p-3 rounded-lg hover:bg-gray-100 transition-colors">
                                <div class="flex flex-wrap items-center gap-2 mb-1">
                                    <a href="{{ route('posts.index',$comment->user) }}" class="font-medium text-sm hover:text-blue-600">
                                        {{$comment->user->username}}
                                    </a>
                                    <span class="text-xs text-gray-400">
                                        <time datetime="{{ $comment->created_at->format('Y-m-d') }}">
                                            {{ $comment->created_at->format('M d, Y') }}
                                        </time> 
                                        • {{ $comment->created_at->diffForHumans() }}
                                    </span>
                                </div>
                                <p class="text-gray-600 text-sm break-words">{{ $comment->comment }}</p>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-500 text-center py-4">Sé el primero en comentar</p>
                @endforelse
            </div>
        </div>
    </div>
@endsection