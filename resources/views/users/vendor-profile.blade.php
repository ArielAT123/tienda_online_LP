@extends('layouts.app')

@section('title', 'Mi Tienda - ' . ($store['name'] ?? $user['name']))

@section('content')
<!-- Header -->
<section class="bg-chocolate-section py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center gap-6">
            @if(!empty($store['logo']))
                <img src="{{ $store['logo'] }}" alt="{{ $store['name'] }}" class="w-24 h-24 object-cover border-2 border-white">
            @else
                <div class="w-24 h-24 bg-accent flex items-center justify-center text-white text-3xl font-bold">
                    {{ strtoupper(substr($store['name'] ?? $user['name'], 0, 1)) }}
                </div>
            @endif
            <div>
                <span class="tag-badge px-3 py-1 mb-2 inline-block">VENDEDOR</span>
                <h1 class="text-3xl font-bold text-white">{{ $store['name'] ?? $user['name'] }}</h1>
                <p class="text-neutral-300 mt-1">{{ $user['email'] }}</p>
            </div>
        </div>
    </div>
</section>

<section class="py-12 px-4 bg-neutral-50">
    <div class="max-w-7xl mx-auto">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <div class="bg-white border border-neutral-200 p-6 sticky top-24">
                    <h3 class="font-bold text-neutral-800 mb-4">Mi Tienda</h3>
                    
                    @if(!empty($store['description']))
                    <p class="text-neutral-600 text-sm mb-6">{{ $store['description'] }}</p>
                    @endif
                    
                    <div class="space-y-3 text-sm">
                        <div class="flex justify-between">
                            <span class="text-neutral-500">Productos</span>
                            <span class="font-bold text-accent">{{ $products_count }}</span>
                        </div>
                    </div>
                    
                    <div class="mt-6 pt-6 border-t border-neutral-200">
                        <a href="{{ route('products.add') }}" class="btn-accent w-full py-3 text-center block font-bold">
                            + AGREGAR PRODUCTO
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Products Grid -->
            <div class="lg:col-span-3">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-bold text-neutral-800">Mis Productos</h2>
                    <span class="text-neutral-500">{{ $products_count }} productos</span>
                </div>
                
                @if(count($products) === 0)
                <div class="bg-white border border-neutral-200 p-12 text-center">
                    <div class="icon-box mx-auto mb-4">
                        <svg class="w-6 h-6 text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-neutral-800 mb-2">Sin productos aún</h3>
                    <p class="text-neutral-500 mb-6">Comienza a agregar productos a tu tienda</p>
                    <a href="{{ route('products.add') }}" class="btn-accent px-6 py-3 inline-block">
                        AGREGAR MI PRIMER PRODUCTO
                    </a>
                </div>
                @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($products as $product)
                    <div class="bg-white border border-neutral-200 overflow-hidden group">
                        <!-- Product Image -->
                        <div class="aspect-square bg-neutral-100 relative overflow-hidden flex items-center justify-center">
                            @if(!empty($product['img']))
                                <img src="{{ $product['img'] }}" alt="{{ $product['name_product'] }}" class="w-full h-full object-cover">
                            @else
                                <svg class="w-16 h-16 text-neutral-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            @endif
                            
                            <!-- Status Badge -->
                            <div class="absolute top-2 left-2">
                                @if(($product['status'] ?? 'ACTIVO') === 'ACTIVO')
                                    <span class="bg-green-600 text-white text-xs font-medium px-2 py-1">ACTIVO</span>
                                @else
                                    <span class="bg-yellow-500 text-white text-xs font-medium px-2 py-1">{{ $product['status'] }}</span>
                                @endif
                            </div>
                        </div>
                        
                        <!-- Product Info -->
                        <div class="p-4">
                            <p class="text-xs text-neutral-400 mb-1">{{ $product['id_product'] }}</p>
                            <h3 class="font-bold text-neutral-800 mb-1">{{ $product['name_product'] }}</h3>
                            <p class="text-accent font-bold text-lg">${{ number_format((float)($product['price'] ?? 0), 2) }}</p>
                            <p class="text-sm text-neutral-500 mt-2">Stock: {{ $product['stock'] ?? 0 }}</p>
                            
                            @if(!empty($product['tags']))
                            <div class="flex flex-wrap gap-1 mt-3">
                                @foreach($product['tags'] as $tag)
                                <span class="text-xs px-2 py-1 bg-neutral-100 text-neutral-600">{{ $tag }}</span>
                                @endforeach
                            </div>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection
