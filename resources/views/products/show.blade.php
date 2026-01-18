@extends('layouts.app')

@section('title', $product['name_product'])

@section('content')
<!-- Header -->
<section class="bg-chocolate-section py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <a href="{{ url()->previous() }}" class="inline-flex items-center text-neutral-300 hover:text-accent mb-4">
            ← Volver
        </a>
        <h1 class="text-4xl font-bold text-white">
            {{ $product['name_product'] }}
        </h1>
        <p class="text-neutral-300 mt-2">
            Código: {{ $product['id_product'] }}
        </p>
    </div>
</section>

<section class="py-16 px-4 bg-neutral-50">
    <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-12">
        
        <!-- Imagen -->
        <div class="bg-white border border-neutral-200 flex items-center justify-center aspect-square overflow-hidden">
            @if(!empty($product['img']))
                <img src="{{ $product['img'] }}" alt="{{ $product['name_product'] }}" class="w-full h-full object-cover">
            @else
                <svg class="w-32 h-32 text-neutral-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
            @endif
        </div>

        <!-- Info -->
        <div>
            <p class="text-accent text-3xl font-bold mb-4">
                ${{ number_format((float)$product['price'], 2) }}
            </p>

            <p class="text-neutral-600 leading-relaxed mb-6">
                {{ $product['description'] ?? 'Sin descripción' }}
            </p>

            <!-- Tags -->
            @if(!empty($product['tags']))
            <div class="flex flex-wrap gap-2 mb-6">
                @foreach($product['tags'] as $tag)
                <span class="tag-badge px-3 py-1">
                    {{ strtoupper($tag) }}
                </span>
                @endforeach
            </div>
            @endif

            <!-- Stock -->
            @if($product['stock'] > 0)
            <p class="text-green-600 font-medium mb-4">
                ✔ En stock ({{ $product['stock'] }} disponibles)
            </p>
            @else
            <p class="text-red-600 font-medium mb-4">
                ✖ Producto agotado
            </p>
            @endif

            <!-- Add to Cart -->
            <form action="{{ route('cart.add') }}" method="POST" class="mb-6">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product['id'] }}">
                <input type="hidden" name="quantity" value="1">
                <button class="btn-accent px-8 py-4"
                    {{ $product['stock'] <= 0 ? 'disabled' : '' }}>
                    Agregar al carrito
                </button>
            </form>

            <!-- Vendor -->
            <p class="text-neutral-400 text-sm">
                Vendido por:
                <span class="font-medium text-neutral-600">
                    {{ $product['vendor_name'] }}
                </span>
            </p>
        </div>
    </div>
</section>
@endsection
