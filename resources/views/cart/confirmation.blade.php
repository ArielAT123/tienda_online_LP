@extends('layouts.app')

@section('title', 'Compra Exitosa')

@section('content')
<section class="py-16 px-4 bg-neutral-50">
    <div class="max-w-3xl mx-auto">
        <!-- Success Message -->
        <div class="bg-white border border-neutral-200 p-12 text-center mb-8">
            <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-10 h-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>
            <h1 class="text-3xl font-bold text-neutral-800 mb-2">¡Compra Exitosa!</h1>
            <p class="text-neutral-600 text-lg">{{ $message }}</p>
            <p class="text-neutral-400 mt-2">Orden #{{ $order['id'] ?? 'N/A' }}</p>
        </div>
        
        <!-- Order Details -->
        <div class="bg-white border border-neutral-200">
            <div class="p-6 border-b border-neutral-200">
                <h2 class="text-lg font-bold text-neutral-800">Resumen del Pedido</h2>
                <p class="text-sm text-neutral-500 mt-1">
                    {{ isset($order['created_at']) ? date('d/m/Y H:i', strtotime($order['created_at'])) : date('d/m/Y H:i') }}
                </p>
            </div>
            
            <!-- Order Items -->
            @if(!empty($order['items']))
            <div class="divide-y divide-neutral-100">
                @foreach($order['items'] as $item)
                <div class="p-6 flex items-center gap-4">
                    <!-- Product Image -->
                    <div class="w-16 h-16 bg-neutral-100 flex-shrink-0 overflow-hidden flex items-center justify-center">
                        @if(!empty($item['img']))
                            <img src="{{ $item['img'] }}" alt="{{ $item['product_name'] }}" class="w-full h-full object-cover">
                        @else
                            <svg class="w-6 h-6 text-neutral-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                        @endif
                    </div>
                    
                    <!-- Item Info -->
                    <div class="flex-1">
                        <h3 class="font-bold text-neutral-800">{{ $item['product_name'] ?? 'Producto' }}</h3>
                        <p class="text-sm text-neutral-500">
                            Cantidad: {{ $item['quantity'] }} × ${{ number_format((float)($item['price'] ?? 0), 2) }}
                        </p>
                        @if(!empty($item['vendor_name']))
                        <p class="text-xs text-neutral-400 mt-1">Vendedor: {{ $item['vendor_name'] }}</p>
                        @endif
                    </div>
                    
                    <!-- Subtotal -->
                    <div class="text-right">
                        <span class="font-bold text-accent">${{ number_format((float)($item['subtotal'] ?? 0), 2) }}</span>
                    </div>
                </div>
                @endforeach
            </div>
            @endif
            
            <!-- Order Total -->
            <div class="p-6 bg-neutral-50 border-t border-neutral-200">
                <div class="flex justify-between items-center">
                    <span class="text-lg font-bold text-neutral-800">Total</span>
                    <span class="text-2xl font-bold text-accent">${{ number_format((float)($order['total'] ?? 0), 2) }}</span>
                </div>
                @if(!empty($order['status']))
                <div class="mt-2">
                    <span class="inline-block px-3 py-1 bg-green-100 text-green-800 text-sm font-medium">
                        {{ $order['status'] }}
                    </span>
                </div>
                @endif
            </div>
        </div>
        
        <!-- Actions -->
        <div class="mt-8 flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('products.tags') }}" class="btn-accent px-8 py-4 text-center font-bold">
                SEGUIR COMPRANDO
            </a>
            <a href="{{ route('home') }}" class="btn-outline px-8 py-4 text-center font-bold">
                VOLVER AL INICIO
            </a>
        </div>
    </div>
</section>
@endsection
