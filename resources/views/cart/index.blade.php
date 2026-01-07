@extends('layouts.app')

@section('title', 'Carrito de Compras')

@section('content')
<!-- Header -->
<section class="bg-chocolate-section py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <p class="text-accent font-medium uppercase tracking-wider mb-2">Tu pedido</p>
        <h1 class="text-4xl font-bold text-white">Carrito de Compras</h1>
    </div>
</section>

<section class="py-16 px-4 bg-neutral-50">
    <div class="max-w-4xl mx-auto">
        @if($error)
        <div class="bg-white border border-neutral-200 p-12 text-center">
            <div class="icon-box border-yellow-200 bg-yellow-50 mx-auto mb-6">
                <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <h2 class="text-xl font-bold text-neutral-800 mb-2">No pudimos cargar tu carrito</h2>
            <p class="text-neutral-500 mb-6">{{ $error }}</p>
            <a href="{{ route('products.tags') }}" class="btn-accent inline-block px-6 py-3">
                EXPLORAR PRODUCTOS
            </a>
        </div>
        @elseif(empty($cart) || count($cart) === 0)
        <div class="bg-white border border-neutral-200 p-16 text-center">
            <div class="icon-box mx-auto mb-6">
                <svg class="w-6 h-6 text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
            </div>
            <h2 class="text-2xl font-bold text-neutral-800 mb-3">Tu carrito está vacío</h2>
            <p class="text-neutral-500 mb-8">¡Descubre productos increíbles y agrégalos a tu carrito!</p>
            <a href="{{ route('products.tags') }}" class="btn-accent inline-block px-8 py-4 font-bold">
                EXPLORAR PRODUCTOS
            </a>
        </div>
        @else
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Cart Items -->
            <div class="lg:col-span-2">
                <div class="bg-white border border-neutral-200">
                    <div class="p-6 border-b border-neutral-200">
                        <h2 class="text-lg font-bold text-neutral-800">Productos ({{ count($cart) }})</h2>
                    </div>
                    
                    <div class="divide-y divide-neutral-100">
                        @foreach($cart as $item)
                        <div class="p-6 flex items-center gap-6">
                            <!-- Product Image -->
                            <div class="w-20 h-20 bg-neutral-100 flex-shrink-0 flex items-center justify-center">
                                <svg class="w-8 h-8 text-neutral-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                </svg>
                            </div>
                            
                            <!-- Product Info -->
                            <div class="flex-1 min-w-0">
                                <h3 class="text-neutral-800 font-medium mb-1">
                                    {{ $item['product'] ?? 'Producto' }}
                                </h3>
                                <p class="text-neutral-500 text-sm">
                                    Cantidad: {{ $item['quantity'] ?? 1 }} × ${{ number_format((float)($item['price'] ?? 0), 2) }}
                                </p>
                            </div>
                            
                            <!-- Subtotal -->
                            <div class="text-right">
                                <p class="text-accent text-xl font-bold">
                                    ${{ number_format((float)($item['subtotal'] ?? 0), 2) }}
                                </p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            
            <!-- Order Summary -->
            <div class="lg:col-span-1">
                <div class="bg-white border border-neutral-200 p-6 sticky top-24">
                    <h2 class="text-lg font-bold text-neutral-800 mb-6">Resumen del Pedido</h2>
                    
                    <div class="space-y-4 mb-6">
                        <div class="flex justify-between text-neutral-600">
                            <span>Subtotal</span>
                            <span>${{ number_format((float)$total, 2) }}</span>
                        </div>
                        <div class="flex justify-between text-neutral-600">
                            <span>Envío</span>
                            <span class="text-green-600">Gratis</span>
                        </div>
                        <div class="divider"></div>
                        <div class="flex justify-between text-neutral-800 font-bold text-lg">
                            <span>Total</span>
                            <span class="text-accent">${{ number_format((float)$total, 2) }}</span>
                        </div>
                    </div>
                    
                    <button class="btn-accent w-full py-4 font-bold mb-4">
                        PROCEDER AL PAGO
                    </button>
                    
                    <a href="{{ route('products.tags') }}" class="block text-center text-neutral-500 hover:text-chocolate">
                        Continuar comprando
                    </a>
                </div>
            </div>
        </div>
        @endif
    </div>
</section>
@endsection
