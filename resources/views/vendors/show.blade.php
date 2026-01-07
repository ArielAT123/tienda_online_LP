@extends('layouts.app')

@section('title', $vendor['name'] ?? 'Perfil de Vendedor')

@section('content')
<!-- Header -->
<section class="bg-chocolate-section py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <a href="{{ route('products.tags') }}" class="inline-flex items-center text-neutral-300 hover:text-accent mb-4">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Volver a productos
        </a>
        <p class="text-accent font-medium uppercase tracking-wider mb-2">Perfil</p>
        <h1 class="text-4xl font-bold text-white">{{ $vendor['name'] ?? 'Vendedor' }}</h1>
    </div>
</section>

<section class="py-16 px-4 bg-neutral-50">
    <div class="max-w-4xl mx-auto">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Vendor Info -->
            <div class="lg:col-span-2">
                <div class="bg-white border border-neutral-200 p-8">
                    <!-- Avatar & Name -->
                    <div class="flex items-start gap-6 mb-8">
                        <div class="w-20 h-20 bg-chocolate flex items-center justify-center flex-shrink-0">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold text-neutral-800">{{ $vendor['name'] ?? 'Vendedor' }}</h2>
                            <p class="text-neutral-500 mt-1">Vendedor verificado</p>
                        </div>
                    </div>
                    
                    <!-- Contact Info -->
                    <div class="space-y-4">
                        <h3 class="text-sm font-bold text-neutral-800 uppercase tracking-wider mb-4">Información de Contacto</h3>
                        
                        @if(isset($vendor['email']))
                        <div class="flex items-center gap-4 p-4 bg-neutral-50 border border-neutral-200">
                            <div class="icon-box flex-shrink-0">
                                <svg class="w-5 h-5 text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs text-neutral-400 uppercase tracking-wider">Email</p>
                                <p class="text-neutral-800 font-medium">{{ $vendor['email'] }}</p>
                            </div>
                        </div>
                        @endif
                        
                        @if(isset($vendor['phone_number']) && $vendor['phone_number'])
                        <div class="flex items-center gap-4 p-4 bg-neutral-50 border border-neutral-200">
                            <div class="icon-box flex-shrink-0">
                                <svg class="w-5 h-5 text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs text-neutral-400 uppercase tracking-wider">Teléfono</p>
                                <p class="text-neutral-800 font-medium">{{ $vendor['phone_number'] }}</p>
                            </div>
                        </div>
                        @endif
                        
                        @if(isset($vendor['direction']) && $vendor['direction'])
                        <div class="flex items-center gap-4 p-4 bg-neutral-50 border border-neutral-200">
                            <div class="icon-box flex-shrink-0">
                                <svg class="w-5 h-5 text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs text-neutral-400 uppercase tracking-wider">Dirección</p>
                                <p class="text-neutral-800 font-medium">{{ $vendor['direction'] }}</p>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            
            <!-- Stats Sidebar -->
            <div class="lg:col-span-1">
                <div class="bg-white border border-neutral-200 p-6 sticky top-24">
                    <h3 class="text-sm font-bold text-neutral-800 uppercase tracking-wider mb-6">Estadísticas</h3>
                    
                    <!-- Rating -->
                    <div class="mb-6">
                        <p class="text-xs text-neutral-400 uppercase tracking-wider mb-2">Calificación</p>
                        @if(isset($vendor['average_rating']) && $vendor['average_rating'] !== null)
                        <div class="flex items-center gap-2">
                            <span class="text-3xl font-bold text-accent">{{ number_format($vendor['average_rating'], 1) }}</span>
                            <svg class="w-6 h-6 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                            </svg>
                        </div>
                        @else
                        <p class="text-neutral-400">Sin calificaciones aún</p>
                        @endif
                    </div>
                    
                    <div class="divider mb-6"></div>
                    
                    <!-- Reviews Count -->
                    <div>
                        <p class="text-xs text-neutral-400 uppercase tracking-wider mb-2">Reseñas</p>
                        <p class="text-2xl font-bold text-neutral-800">{{ count($vendor['reviews'] ?? []) }}</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Reviews Section -->
        @if(isset($vendor['reviews']) && count($vendor['reviews']) > 0)
        <div class="mt-8">
            <h2 class="text-lg font-bold text-neutral-800 mb-6">Reseñas de Clientes</h2>
            <div class="space-y-4">
                @foreach($vendor['reviews'] as $review)
                <div class="bg-white border border-neutral-200 p-6">
                    <div class="flex items-center justify-between mb-4">
                        <span class="font-medium text-neutral-800">{{ $review['user'] ?? 'Usuario' }}</span>
                        <div class="flex items-center">
                            @for($i = 1; $i <= 5; $i++)
                            <svg class="w-4 h-4 {{ $i <= ($review['rating'] ?? 0) ? 'text-yellow-500' : 'text-neutral-200' }}" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                            </svg>
                            @endfor
                        </div>
                    </div>
                    <p class="text-neutral-600 leading-relaxed">{{ $review['comment'] ?? '' }}</p>
                </div>
                @endforeach
            </div>
        </div>
        @else
        <div class="mt-8 bg-white border border-neutral-200 p-8 text-center">
            <h2 class="text-lg font-bold text-neutral-800 mb-2">Sin reseñas aún</h2>
            <p class="text-neutral-500">Este vendedor no tiene reseñas todavía.</p>
        </div>
        @endif
    </div>
</section>
@endsection
