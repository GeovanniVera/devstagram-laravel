@extends('layouts.app')

@section('content')

    @forelse ($posts as $post )
        <div class="container w-full md:w-3/6 mx-auto flex flex-col p-4 md:p-10 gap-5">
            <x-show-post :post="$post" />
        </div>
        
    @empty
    <h1 class="text-center text-2xl text-gray-600 mb-50">
        No hay publicaciones, sigue a alguen para poder mostrar sus publicaciones. 
    </h1>
    @endforelse
@endsection