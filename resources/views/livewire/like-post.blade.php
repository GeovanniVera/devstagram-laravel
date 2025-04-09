<div>
    <button 
        wire:click="like"
        class="flex items-center gap-1 hover:text-red-500 transition-colors group
        @if ($isLiked) text-red-700 @endif">
        <svg class="w-6 h-6 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
        </svg>
        <span class="text-sm">{{ $likesCount }}</span>
        
    </button>

    
</div>