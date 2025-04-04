@extends('layouts.app')

@section('title')
    Agrega un nuevo Post
@endsection

@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
@endpush

@section('content')
    <div class="md:flex md:items-center p-10 gap-10">
        <div class="md:w-1/2">
            <form 
            method="POST"
            enctype="multipart/form-data"
            action="{{ route('images.store') }}"
            id="dropzone" 
            class="
                dropzone 
                border-dashed 
                border 
                border-gray-600 
                w-full 
                h-96 
                rounded 
                flex 
                flex-coll 
                justify-center 
                items-center">
                @csrf
            </form>
        </div>
        <div class="md:w-1/2 px-10 bg-white shadow-xl p-6 mt-10 md:mt-0">
            <form action="{{ route('posts.store') }}" method="POST" novalidate>
                <div>
                    <h2 class="font-black text-center text-3xl mb-10">
                        Crea tu Post
                    </h2>
                </div>
                @if (session('message'))
                    <p class="text-red-600 mb-3 mt-2 text-center ">{{ session('message') }}</p>
                @endif
                @csrf
                <div class="mb-8">
                    <label 
                        for="title" 
                        class="mb-2 
                        block uppercase 
                        text-gray-500 
                        font-bold
                        ">
                        Titulo:
                    </label>
                    <input
                        type="title"
                        name="title"
                        id="title"
                        autofocus
                        placeholder="Titulo de la publicaciòn."
                        class="
                        border
                        focus:outline-indigo-600
                        border-gray-500
                        p-3
                        w-full
                        @error('title')
                            border-red-600
                        @enderror
                        "
                        value="{{ old('title') }}">
                    @error('title')
                        <p class="text-red-600 mt-3">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-8">
                    <label 
                        for="description" 
                        class="mb-2 
                        block uppercase 
                        text-gray-500 
                        font-bold
                        ">
                        Descripcion:
                    </label>
                    <textarea 
                        name="description"
                        id="description"
                        placeholder="Descripicon de la publicacion"
                        class="
                        border
                        focus:outline-indigo-600
                        border-gray-500
                        p-3
                        w-full
                        @error('description')
                            border-red-600
                        @enderror
                        "> {{ old('description') }}</textarea>
                    @error('description')
                        <p class="text-red-600 mt-3">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-5">
                    <input 
                        type="hidden"
                        name="image"
                        value="{{ old('image') }}"
                        >
                </div>
                <div class="mb-5">
                    <input 
                        type="submit"
                        value="Publicar"
                        class="
                        border
                        border-gray-500
                        bg-indigo-700
                        hover:bg-indigo-900
                        transition-colors
                        cursor-pointer
                        text-amber-50
                        p-3
                        rounded-md
                        w-full">
                </div>
                
            </form>
        </div>
    </div>
@endsection