@extends('layouts.app')

@section('title', 'Inicio')

@section('content')
<!-- Hero Section -->
<section class="bg-chocolate-section">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div>
                <p class="text-accent font-medium uppercase tracking-wider mb-4">Bienvenido a tu tienda</p>
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-6 leading-tight">
                    Productos de calidad para ti
                </h1>
                <p class="text-neutral-300 text-lg mb-8 leading-relaxed max-w-lg">
                    Descubre productos únicos de vendedores verificados. Compra con confianza, recibe con rapidez.
                </p>
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="{{ route('products.tags') }}" class="btn-accent px-8 py-4 text-center font-bold">
                        EXPLORAR PRODUCTOS
                    </a>
                    <a href="{{ route('auth.register-vendor') }}" class="btn-outline border-white text-white hover:bg-white hover:text-chocolate px-8 py-4 text-center">
                        SER VENDEDOR
                    </a>
                </div>
            </div>
            <div class="hidden lg:block">
                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-white/10 p-8 flex items-center justify-center h-40">
                        <svg class="w-16 h-16 text-white/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                    </div>
                    <div class="bg-accent p-8 flex items-center justify-center h-40">
                        <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                    </div>
                    <div class="bg-accent p-8 flex items-center justify-center h-40">
                        <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                        </svg>
                    </div>
                    <div class="bg-white/10 p-8 flex items-center justify-center h-40">
                        <svg class="w-16 h-16 text-white/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Categories Section -->
@if(count($tags) > 0)
<section class="py-20 px-4 bg-white">
    <div class="max-w-7xl mx-auto">
        <div class="flex items-center justify-between mb-12">
            <div>
                <p class="text-accent font-medium uppercase tracking-wider mb-2">Explorar</p>
                <h2 class="text-3xl font-bold text-neutral-800">Categorías</h2>
            </div>
            <a href="{{ route('products.tags') }}" class="text-chocolate font-medium hover:text-accent flex items-center">
                Ver todas
                <svg class="w-5 h-5 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                </svg>
            </a>
        </div>
        
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($tags as $key => $tag)
            @php
                $tagValue = is_array($tag) ? ($tag['value'] ?? $tag['nombre'] ?? (string)$key) : (string)$tag;
                $tagLabel = is_array($tag) ? ($tag['label'] ?? $tag['nombre'] ?? $tagValue) : (string)$tag;
            @endphp
            <a href="{{ route('products.by-tag', $tagValue) }}" class="corp-card p-6 group">
                <div class="icon-box mb-4 group-hover:bg-chocolate group-hover:border-chocolate transition-colors">
                    <svg class="w-6 h-6 text-neutral-400 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A2 2 0 013 12V7a4 4 0 014-4z"></path>
                    </svg>
                </div>
                <h3 class="text-neutral-800 font-bold text-lg group-hover:text-accent transition-colors">{{ $tagLabel }}</h3>
                <p class="text-neutral-400 text-sm mt-1">Ver productos</p>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Features Section -->
<section class="py-20 px-4 bg-neutral-100">
    <div class="max-w-7xl mx-auto">
        <div class="text-center mb-16">
            <p class="text-accent font-medium uppercase tracking-wider mb-2">¿Por qué elegirnos?</p>
            <h2 class="text-3xl font-bold text-neutral-800">Beneficios</h2>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Feature 1 -->
            <div class="bg-white p-8 border border-neutral-200">
                <div class="icon-box bg-chocolate border-chocolate mb-6">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-neutral-800 mb-3">Compra Segura</h3>
                <p class="text-neutral-500 leading-relaxed">Tus transacciones están protegidas con los más altos estándares de seguridad.</p>
            </div>
            
            <!-- Feature 2 -->
            <div class="bg-white p-8 border border-neutral-200">
                <div class="icon-box bg-accent border-accent mb-6">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-neutral-800 mb-3">Envío Rápido</h3>
                <p class="text-neutral-500 leading-relaxed">Recibe tus productos en tiempo récord con nuestro sistema de logística optimizado.</p>
            </div>
            
            <!-- Feature 3 -->
            <div class="bg-white p-8 border border-neutral-200">
                <div class="icon-box bg-chocolate border-chocolate mb-6">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-neutral-800 mb-3">Vendedores Verificados</h3>
                <p class="text-neutral-500 leading-relaxed">Compra con confianza a vendedores de calidad verificados por nuestro equipo.</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-20 px-4 bg-white">
    <div class="max-w-4xl mx-auto">
        <div class="bg-chocolate-section p-12 text-center">
            <h2 class="text-3xl font-bold text-white mb-4">¿Tienes productos para vender?</h2>
            <p class="text-neutral-300 mb-8 max-w-2xl mx-auto leading-relaxed">
                Únete a nuestra comunidad de vendedores y llega a miles de clientes potenciales. Sin comisiones ocultas.
            </p>
            <a href="{{ route('auth.register-vendor') }}" class="btn-accent px-10 py-4 inline-block font-bold">
                COMENZAR A VENDER
            </a>
        </div>
    </div>
</section>
@endsection
