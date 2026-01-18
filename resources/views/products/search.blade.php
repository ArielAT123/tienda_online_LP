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
                    <div class="bg-white border p-4">
                        <a href="{{ route('products.show', $product['id']) }}"><h3 class="text-neutral-800 font-bold text-lg hover:text-accent">{{ $product['name_product'] }}</h3></a>
                    
                        <p class="text-sm text-neutral-500">
                            ${{ $product['price'] }}
                        </p>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>
@endsection