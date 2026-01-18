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
            <form method="POST" action="{{ route('products.add.store') }}" class="space-y-6" enctype="multipart/form-data">
                @csrf
                
                <!-- Product ID -->
                <div>
                    <label for="id_product" class="block text-sm font-medium text-neutral-700 mb-2">Código del Producto *</label>
                    <input type="text" id="id_product" name="id_product" value="{{ old('id_product') }}" required
                        class="input-corp w-full px-4 py-3"
                        placeholder="PROD-001">
                </div>


                <!-- Image Upload -->
                <div>
                    <label class="block text-sm font-medium text-neutral-700 mb-2">Imagen del Producto</label>
                    <div id="image-upload-area" class="border-2 border-dashed border-neutral-300 rounded-lg p-6 text-center cursor-pointer hover:border-chocolate transition-colors">
                        <input type="file" id="image" name="image" accept="image/*" class="hidden">
                        <div id="image-placeholder">
                            <svg class="mx-auto h-12 w-12 text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <p class="mt-2 text-sm text-neutral-600">Haz clic o arrastra una imagen aquí</p>
                            <p class="mt-1 text-xs text-neutral-400">PNG, JPG, WEBP (máx. 5MB)</p>
                        </div>
                        <div id="image-preview" class="hidden">
                            <img id="preview-img" src="" alt="Preview" class="mx-auto max-h-48 rounded-lg">
                            <button type="button" id="remove-image" class="mt-2 text-sm text-red-600 hover:text-red-800">
                                Eliminar imagen
                            </button>
                        </div>
                    </div>
                    @error('image')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
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

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const uploadArea = document.getElementById('image-upload-area');
    const fileInput = document.getElementById('image');
    const placeholder = document.getElementById('image-placeholder');
    const preview = document.getElementById('image-preview');
    const previewImg = document.getElementById('preview-img');
    const removeBtn = document.getElementById('remove-image');

    // Click to select file
    uploadArea.addEventListener('click', function(e) {
        if (e.target !== removeBtn) {
            fileInput.click();
        }
    });

    // Handle file selection
    fileInput.addEventListener('change', function() {
        handleFile(this.files[0]);
    });

    // Drag and drop
    uploadArea.addEventListener('dragover', function(e) {
        e.preventDefault();
        this.classList.add('border-chocolate', 'bg-chocolate/5');
    });

    uploadArea.addEventListener('dragleave', function(e) {
        e.preventDefault();
        this.classList.remove('border-chocolate', 'bg-chocolate/5');
    });

    uploadArea.addEventListener('drop', function(e) {
        e.preventDefault();
        this.classList.remove('border-chocolate', 'bg-chocolate/5');
        
        const files = e.dataTransfer.files;
        if (files.length > 0 && files[0].type.startsWith('image/')) {
            fileInput.files = files;
            handleFile(files[0]);
        }
    });

    // Remove image
    removeBtn.addEventListener('click', function(e) {
        e.stopPropagation();
        fileInput.value = '';
        placeholder.classList.remove('hidden');
        preview.classList.add('hidden');
        previewImg.src = '';
    });

    function handleFile(file) {
        if (!file || !file.type.startsWith('image/')) return;
        
        const reader = new FileReader();
        reader.onload = function(e) {
            previewImg.src = e.target.result;
            placeholder.classList.add('hidden');
            preview.classList.remove('hidden');
        };
        reader.readAsDataURL(file);
    }
});
</script>
@endpush
