    <!-- Descripción del post -->
    <article class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
        <div class="relative overflow-hidden">
            <a href="{{ route('posts.show',['user' => $post->user->username, 'post' => $post]) }}">
                <img 
                    src="{{ asset('uploads') . '/' . $post->image }}" 
                    alt="Post Image {{ $post->title }}" 
                    class="w-full aspect-video object-cover transform transition-transform duration-300 hover:scale-105">
            </a>
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
                <livewire:like-post :post="$post" />
                
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