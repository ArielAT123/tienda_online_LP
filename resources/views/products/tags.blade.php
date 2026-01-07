@extends('layouts.app')

@section('title', 'Categorías')

@section('content')
<!-- Header -->
<section class="bg-chocolate-section py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <p class="text-accent font-medium uppercase tracking-wider mb-2">Explorar</p>
        <h1 class="text-4xl font-bold text-white">Categorías</h1>
        <p class="text-neutral-300 mt-2">Encuentra productos por categoría</p>
    </div>
</section>

<section class="py-16 px-4 bg-neutral-50">
    <div class="max-w-7xl mx-auto">
        @if($error)
        <div class="bg-white border border-neutral-200 p-12 text-center max-w-lg mx-auto">
            <div class="icon-box border-red-200 bg-red-50 mx-auto mb-6">
                <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                </svg>
            </div>
            <h2 class="text-xl font-bold text-neutral-800 mb-2">Error de conexión</h2>
            <p class="text-neutral-500">{{ $error }}</p>
            <p class="text-neutral-400 text-sm mt-2">Asegúrate de que el servidor API esté ejecutándose.</p>
        </div>
        @elseif(count($tags) === 0)
        <div class="bg-white border border-neutral-200 p-12 text-center max-w-lg mx-auto">
            <div class="icon-box mx-auto mb-6">
                <svg class="w-6 h-6 text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A2 2 0 013 12V7a4 4 0 014-4z"></path>
                </svg>
            </div>
            <h2 class="text-xl font-bold text-neutral-800 mb-2">Sin categorías</h2>
            <p class="text-neutral-500">No hay categorías disponibles en este momento.</p>
        </div>
        @else
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($tags as $key => $tag)
            @php
                $tagValue = is_array($tag) ? ($tag['value'] ?? $tag['nombre'] ?? '') : (string)$tag;
                $tagLabel = is_array($tag) ? ($tag['label'] ?? $tag['nombre'] ?? $tagValue) : (string)$tag;
            @endphp
            <a href="{{ route('products.by-tag', $tagValue) }}" class="corp-card p-8 group">
                <div class="icon-box mb-6 group-hover:bg-chocolate group-hover:border-chocolate transition-colors">
                    <svg class="w-6 h-6 text-neutral-400 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A2 2 0 013 12V7a4 4 0 014-4z"></path>
                    </svg>
                </div>
                <h3 class="text-neutral-800 font-bold text-xl mb-2 group-hover:text-accent transition-colors">{{ $tagLabel }}</h3>
                <p class="text-neutral-400 text-sm">Explorar productos →</p>
            </a>
            @endforeach
        </div>
        @endif
    </div>
</section>
@endsection
