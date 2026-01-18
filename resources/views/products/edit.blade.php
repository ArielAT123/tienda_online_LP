@extends('layouts.app')

@section('title', 'Editar Producto')

@section('content')
<!-- Header -->
<section class="bg-chocolate-section py-16">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <p class="text-accent font-medium uppercase tracking-wider mb-2">Vendedor</p>
        <h1 class="text-4xl font-bold text-white">Editar Producto</h1>
        <p class="text-neutral-300 mt-2">Edita los datos del producto y guarda los cambios (simulado)</p>
    </div>
</section>

<section class="py-16 px-4 bg-neutral-50">
    <div class="max-w-2xl mx-auto">
        <div class="bg-white border border-neutral-200 p-8">
            <form method="POST" action="{{ route('products.update', ['id' => $product['id']]) }}" class="space-y-6">
                @csrf
                <div class="grid grid-cols-2 gap-6">
                    <div>
                        <label for="id_product" class="block text-sm font-medium text-neutral-700 mb-2">Código del Producto *</label>
                        <input type="text" id="id_product" name="id_product" value="{{ old('id_product', $product['id_product'] ?? '') }}" required
                            class="input-corp w-full px-4 py-3"
                            placeholder="PROD-001">
                    </div>

                    <div>
                        <label for="price" class="block text-sm font-medium text-neutral-700 mb-2">Precio ($) *</label>
                        <input type="number" id="price" name="price" value="{{ old('price', $product['price'] ?? '') }}" required step="0.01" min="0"
                            class="input-corp w-full px-4 py-3"
                            placeholder="1500.00">
                    </div>
                </div>

                <div>
                    <label for="name_product" class="block text-sm font-medium text-neutral-700 mb-2">Nombre del Producto *</label>
                    <input type="text" id="name_product" name="name_product" value="{{ old('name_product', $product['name_product'] ?? '') }}" required
                        class="input-corp w-full px-4 py-3"
                        placeholder="Laptop Gaming MSI">
                </div>

                <div>
                    <label for="description" class="block text-sm font-medium text-neutral-700 mb-2">Descripción</label>
                    <textarea id="description" name="description" rows="4"
                        class="input-corp w-full px-4 py-3 resize-none"
                        placeholder="Describe las características del producto...">{{ old('description', $product['description'] ?? '') }}</textarea>
                </div>

                <div class="grid grid-cols-2 gap-6">
                    <div>
                        <label for="stock" class="block text-sm font-medium text-neutral-700 mb-2">Stock *</label>
                        <input type="number" id="stock" name="stock" value="{{ old('stock', $product['stock'] ?? '') }}" required min="0"
                            class="input-corp w-full px-4 py-3"
                            placeholder="10">
                    </div>

                    <div>
                        <label for="tags_text" class="block text-sm font-medium text-neutral-700 mb-2">Etiquetas</label>
                        <input type="text" id="tags_text" name="tags_text" value="{{ old('tags_text', implode(',', $product['tags'] ?? [])) }}" class="input-corp w-full px-4 py-3" placeholder="gaming, laptop">
                    </div>
                </div>

                <div class="pt-4">
                    <button type="submit" class="w-full py-4 bg-blue-600 hover:bg-blue-700 text-white rounded-md font-bold">GUARDAR CAMBIOS</button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection