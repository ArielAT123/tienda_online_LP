@extends('layouts.app')

@section('title', 'Agregar Producto')

@section('content')
<!-- Header -->
<section class="bg-chocolate-section py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <a href="{{ route('products.tags') }}" class="inline-flex items-center text-neutral-300 hover:text-accent mb-4">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Volver
        </a>
        <p class="text-accent font-medium uppercase tracking-wider mb-2">Vendedor</p>
        <h1 class="text-4xl font-bold text-white">Agregar Producto</h1>
    </div>
</section>

<section class="py-16 px-4 bg-neutral-50">
    <div class="max-w-2xl mx-auto">
        <div class="bg-white border border-neutral-200 p-8">
            <!-- Form -->
            <form method="POST" action="{{ route('products.add.store') }}" class="space-y-6">
                @csrf
                
                <div class="grid grid-cols-2 gap-6">
                    <!-- Product ID -->
                    <div>
                        <label for="id_product" class="block text-sm font-medium text-neutral-700 mb-2">Código del Producto *</label>
                        <input type="text" id="id_product" name="id_product" value="{{ old('id_product') }}" required
                            class="input-corp w-full px-4 py-3"
                            placeholder="PROD-001">
                    </div>
                    
                    <!-- Vendor ID -->
                    <div>
                        <label for="vendor_id" class="block text-sm font-medium text-neutral-700 mb-2">ID del Vendedor *</label>
                        <input type="number" id="vendor_id" name="vendor_id" value="{{ old('vendor_id', session('user_id', 1)) }}" required
                            class="input-corp w-full px-4 py-3"
                            placeholder="1">
                    </div>
                </div>
                
                <!-- Product Name -->
                <div>
                    <label for="name_product" class="block text-sm font-medium text-neutral-700 mb-2">Nombre del Producto *</label>
                    <input type="text" id="name_product" name="name_product" value="{{ old('name_product') }}" required
                        class="input-corp w-full px-4 py-3"
                        placeholder="Laptop Gaming MSI">
                </div>
                
                <!-- Description -->
                <div>
                    <label for="description" class="block text-sm font-medium text-neutral-700 mb-2">Descripción</label>
                    <textarea id="description" name="description" rows="4"
                        class="input-corp w-full px-4 py-3 resize-none"
                        placeholder="Describe las características del producto...">{{ old('description') }}</textarea>
                </div>
                
                <div class="grid grid-cols-2 gap-6">
                    <!-- Price -->
                    <div>
                        <label for="price" class="block text-sm font-medium text-neutral-700 mb-2">Precio ($) *</label>
                        <input type="number" id="price" name="price" value="{{ old('price') }}" required step="0.01" min="0"
                            class="input-corp w-full px-4 py-3"
                            placeholder="1500.00">
                    </div>
                    
                    <!-- Stock -->
                    <div>
                        <label for="stock" class="block text-sm font-medium text-neutral-700 mb-2">Stock *</label>
                        <input type="number" id="stock" name="stock" value="{{ old('stock') }}" required min="0"
                            class="input-corp w-full px-4 py-3"
                            placeholder="10">
                    </div>
                </div>
                
                <!-- Tags -->
                <div>
                    <label class="block text-sm font-medium text-neutral-700 mb-4">Etiquetas</label>
                    @if(count($tags) > 0)
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                        @foreach($tags as $tag)
                        @php
                            $tagValue = is_array($tag) ? ($tag['value'] ?? '') : (string)$tag;
                            $tagLabel = is_array($tag) ? ($tag['label'] ?? $tagValue) : (string)$tag;
                        @endphp
                        <label class="flex items-center space-x-2 bg-neutral-50 border border-neutral-200 p-3 cursor-pointer hover:border-chocolate transition-colors">
                            <input type="checkbox" name="tags[]" value="{{ $tagValue }}" 
                                class="w-4 h-4 border-neutral-300 text-accent focus:ring-accent"
                                {{ in_array($tagValue, old('tags', [])) ? 'checked' : '' }}>
                            <span class="text-neutral-700 text-sm">{{ $tagLabel }}</span>
                        </label>
                        @endforeach
                    </div>
                    @else
                    <input type="text" name="tags_text" value="{{ old('tags_text') }}"
                        class="input-corp w-full px-4 py-3"
                        placeholder="gaming, laptop, pc (separados por coma)">
                    <p class="text-neutral-400 text-xs mt-2">Separa las etiquetas con comas</p>
                    @endif
                </div>
                
                <!-- Submit Button -->
                <div class="pt-4">
                    <button type="submit" class="btn-accent w-full py-4 font-bold">
                        PUBLICAR PRODUCTO
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
