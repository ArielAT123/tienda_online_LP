@extends('layouts.app')

@section('title', 'Productos: ' . ucfirst($tag))

@section('content')
<!-- Header -->
<section class="bg-chocolate-section py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <a href="{{ route('products.tags') }}" class="inline-flex items-center text-neutral-300 hover:text-accent mb-4 group">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Categorías
        </a>
        <div class="flex items-center gap-3 mb-2">
            <span class="tag-badge px-3 py-1">{{ strtoupper($tag) }}</span>
        </div>
        <h1 class="text-4xl font-bold text-white capitalize">{{ $tag }}</h1>
        <p class="text-neutral-300 mt-2">{{ count($products) }} productos encontrados</p>
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
            <h2 class="text-xl font-bold text-neutral-800 mb-2">Error</h2>
            <p class="text-neutral-500">{{ $error }}</p>
        </div>
        @elseif(count($products) === 0)
        <div class="bg-white border border-neutral-200 p-12 text-center max-w-lg mx-auto">
            <div class="icon-box mx-auto mb-6">
                <svg class="w-6 h-6 text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                </svg>
            </div>
            <h2 class="text-xl font-bold text-neutral-800 mb-2">Sin productos</h2>
            <p class="text-neutral-500">No hay productos en esta categoría.</p>
            <a href="{{ route('products.tags') }}" class="btn-chocolate inline-block mt-6 px-6 py-3">
                VER OTRAS CATEGORÍAS
            </a>
        </div>
        @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($products as $product)
            <div class="bg-white border border-neutral-200 group">
                <!-- Product Image -->
                <div class="aspect-square bg-neutral-100 relative overflow-hidden flex items-center justify-center">
                    @if(!empty($product['img']))
                        <img src="{{ $product['img'] }}" alt="{{ $product['name_product'] }}" class="w-full h-full object-cover">
                    @else
                        <svg class="w-20 h-20 text-neutral-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    @endif
                    
                    <!-- Status Badge -->
                    <div class="absolute top-4 left-4">
                        @if(($product['stock'] ?? 0) > 0)
                        <span class="bg-green-600 text-white text-xs font-medium px-2 py-1">
                            EN STOCK
                        </span>
                        @else
                        <span class="bg-red-600 text-white text-xs font-medium px-2 py-1">
                            AGOTADO
                        </span>
                        @endif
                    </div>
                    
                    @if(isset($product['status']) && $product['status'] !== 'ACTIVO')
                    <div class="absolute top-4 right-4">
                        <span class="bg-yellow-500 text-white text-xs font-medium px-2 py-1">
                            {{ $product['status'] }}
                        </span>
                    </div>
                    @endif
                </div>
                
                <!-- Product Info -->
                <div class="p-6">
                    <p class="text-neutral-400 text-xs uppercase tracking-wider mb-1">{{ $product['id_product'] ?? '' }}</p>
                    <a href="{{ route('products.show', $product['id']) }}"><h3 class="text-neutral-800 font-bold text-lg hover:text-accent">{{ $product['name_product'] }}</h3></a>
                    
                    @if(isset($product['description']) && $product['description'])
                    <p class="text-neutral-500 text-sm mb-4 line-clamp-2 leading-relaxed">{{ $product['description'] }}</p>
                    @endif
                    
                    <!-- Tags -->
                    @if(isset($product['tags']) && is_array($product['tags']))
                    <div class="flex flex-wrap gap-2 mb-4">
                        @foreach($product['tags'] as $productTag)
                        <span class="text-xs px-2 py-1 bg-neutral-100 text-neutral-600">{{ $productTag }}</span>
                        @endforeach
                    </div>
                    @endif
                    
                    <div class="flex items-center justify-between pt-4 border-t border-neutral-100">
                        <span class="text-accent text-2xl font-bold">${{ number_format((float)($product['price'] ?? 0), 2) }}</span>
                        
                        <form action="{{ route('cart.add') }}" method="POST" class="inline">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product['id'] }}">
                            <input type="hidden" name="quantity" value="1">
                            <button type="submit" class="btn-chocolate p-3" title="Agregar al carrito" {{ ($product['stock'] ?? 0) <= 0 ? 'disabled' : '' }}>
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                            </button>
                        </form>
                    </div>
                    
                    @if(isset($product['vendor']) && isset($product['vendor']['id']))
                    <a href="{{ route('vendors.show', $product['vendor']['id']) }}" class="block mt-4 text-sm text-neutral-400 hover:text-accent transition-colors">
                        Vendedor: {{ $product['vendor']['name'] ?? 'Ver perfil' }}
                    </a>
                    @elseif(isset($product['vendor_name']))
                    <span class="block mt-4 text-sm text-neutral-400">
                        Vendedor: {{ $product['vendor_name'] }}
                    </span>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</section>
@endsection
