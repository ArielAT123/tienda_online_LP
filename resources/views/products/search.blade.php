@extends('layouts.app')

@section('title', 'Buscar productos')

@section('content')
<section class="py-16 bg-neutral-50">
    <div class="max-w-7xl mx-auto px-4">

        <h1 class="text-3xl font-bold mb-6">Buscar productos</h1>

        <!-- Filtros -->
        <form method="GET" action="{{ route('products.search') }}"
              class="bg-white p-6 border border-neutral-200 mb-8">

            <!-- Search -->
            <input type="text"
                   name="q"
                   value="{{ $query }}"
                   placeholder="Buscar producto..."
                   class="w-full mb-4 border p-3">

            <!-- Tags -->
            <div class="flex flex-wrap gap-3">
                @foreach($tags as $tag)
                    @php
                        $value = $tag['value'] ?? $tag;
                    @endphp
                    <label class="flex items-center gap-2 text-sm">
                        <input type="checkbox"
                               name="tags[]"
                               value="{{ $value }}"
                               {{ in_array($value, $selectedTags ?? []) ? 'checked' : '' }}>
                        {{ ucfirst($value) }}
                    </label>
                @endforeach
            </div>

            <button type="submit" class="btn-chocolate mt-6 px-6 py-3">
                Filtrar
            </button>
        </form>

        <!-- Resultados -->
        @if(count($products) === 0)
            <p class="text-neutral-500">No se encontraron productos.</p>
        @else
            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach($products as $product)
                    <div class="bg-white border border-neutral-200 overflow-hidden group">
                        <!-- Product Image -->
                        <div class="aspect-square bg-neutral-100 overflow-hidden flex items-center justify-center">
                            @if(!empty($product['img']))
                                <img src="{{ $product['img'] }}" alt="{{ $product['name_product'] }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                            @else
                                <svg class="w-16 h-16 text-neutral-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            @endif
                        </div>
                        <!-- Product Info -->
                        <div class="p-4">
                            <a href="{{ route('products.show', $product['id']) }}">
                                <h3 class="text-neutral-800 font-bold text-lg hover:text-accent transition-colors">{{ $product['name_product'] }}</h3>
                            </a>
                            <p class="text-accent font-bold text-lg mt-2">
                                ${{ number_format((float)($product['price'] ?? 0), 2) }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>
@endsection