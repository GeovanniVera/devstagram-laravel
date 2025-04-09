@extends('layouts.app')

@section('content')
    <div class="container w-full md:w-3/6 mx-auto flex flex-col p-4 md:p-10 gap-5">
        <!-- Descripción del post -->
        <x-show-post :post="$post" />
    
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
                            src=" {{ asset('profile' . '/' . $comment->user->image) }}" 
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