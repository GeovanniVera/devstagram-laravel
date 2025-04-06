@extends('layouts.app')


@section('content')
    <div class="container w-full md:w-3/6 mx-auto flex flex-col  p-10 gap-5">
        <!-- Descripcion del post -->
        <article class="bg-white rounded-xl shadow-lg overflow-hidden">
            <img 
                src="{{ asset('uploads') . '/' . $post->image }}" 
                alt="Post Image {{ $post->title }}" 
                class="w-full aspect-video object-cover hover:scale-105 transition-transform duration-300">
            
            <div class="p-4 md:p-6">
                <div class="flex items-center gap-3 mb-4">
                    
                    <div>
                        <h2 class="font-bold text-gray-800 hover:text-indigo-600 transition-colors cursor-pointer mb-5">
                            {{ $post->user->username }}
                        </h2>
                        <p class="text-xs text-gray-500">
                            {{ $post->created_at->format('M d, Y') }} • {{ $post->created_at->diffForHumans() }}
                        </p>
                    </div>
                </div>
    
                <p class="text-gray-700 leading-relaxed mb-4">
                    {{ $post->description }}
                </p>
    
                <div class="flex items-center gap-4 text-gray-500">
                    <button class="flex items-center gap-1 hover:text-red-500 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                        </svg>
                        <span class="text-sm">0</span>
                    </button>
                    <span class="text-sm">•</span>
                    <button class="flex items-center gap-1 hover:text-blue-500 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                        </svg>
                        <span class="text-sm">{{$post->comments->count()}} comments</span>
                    </button>
                </div>
            </div>
        </article>
    
        <!-- Caja de comentarios-->
        <div class="bg-white rounded-xl shadow-lg p-4 md:p-6">
            <h3 class="font-semibold text-lg mb-4">Comments ({{ $post->comments->count() }})</h3>
            
            <!-- Comment Form -->
            <form class="mb-6" novalidate method="POST" action="{{ route('comments.store', ['post' => $post]) }}">
                @csrf
                <div class="flex gap-3">
                    <input 
                        name="comment"
                        type="text" 
                        value="{{ old('comment') }}"
                        placeholder="Agregar Comentario..."
                        class="flex-1 rounded-full px-4 py-2 border border-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('comment')
                        border-red-600                             
                        @enderror">
                        <p class="text-red-600 text-sm"></p>
                    <button 
                        type="submit"
                        class=" cursor-pointer  px-4 py-2 bg-blue-500 text-white rounded-full hover:bg-blue-600 transition-colors">
                        Publicar
                    </button>
                </div>
            </form>
            <!-- Lista de Comentarios -->
            <div class="space-y-4">
                <!-- Comentario -->
                @foreach($post->comments as $comment)
                <div class="flex gap-3">
                    <img 
                        src="https://i.pravatar.cc/40?img=1" 
                        alt="User avatar" 
                        class="h-8 w-8 rounded-full">
                    <div class="flex-1">
                        <div class="bg-gray-50 p-3 rounded-lg">
                            <div class="flex items-center gap-2 mb-1">
                                <span class="font-medium text-sm">{{$comment->user->username}}</span>
                                <span class="text-xs text-gray-400">• {{ $comment->created_at->format('M d, Y') }} • {{ $comment->created_at->diffForHumans() }}</span>
                            </div>
                            <p class="text-gray-600 text-sm">{{ $comment->comment }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection