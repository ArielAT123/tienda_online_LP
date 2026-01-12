@extends('layouts.app')

@section('title', 'Registro de Vendedor')

@section('content')
<!-- Header -->
<section class="bg-blue-50 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <p class="text-blue-600 font-medium uppercase tracking-wider mb-2">Únete</p>
        <h1 class="text-4xl font-bold text-blue-600">Convertirse en Vendedor</h1>
        <p class="text-neutral-600 mt-2">Abre tu tienda y empieza a vender hoy</p>
    </div>
</section>

<section class="py-16 px-4 bg-neutral-50">
    <div class="max-w-2xl mx-auto">
        <div class="bg-white border border-neutral-200 p-8">
            <!-- Form -->
            <form method="POST" action="{{ route('auth.register-vendor.store') }}" class="space-y-8">
                @csrf
                
                <!-- Personal Info Section -->
                <div>
                    <h3 class="text-lg font-bold text-neutral-800 mb-6 pb-2 border-b border-neutral-200">Información Personal</h3>
                    
                    <div class="space-y-5">
                        <!-- Name -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-neutral-700 mb-2">Nombre Completo *</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-neutral-400">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </span>
                                <input type="text" id="name" name="name" value="{{ old('name') }}" required
                                    class="w-full px-4 py-3 pl-10 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-200"
                                    placeholder="Carlos García">
                            </div>
                        </div>
                        
                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-neutral-700 mb-2">Correo Electrónico *</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-neutral-400">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.5 5L18 8m1-1H3a2 2 0 00-2 2v8a2 2 0 002 2h18a2 2 0 002-2V9a2 2 0 00-2-2z"></path>
                                    </svg>
                                </span>
                                <input type="email" id="email" name="email" value="{{ old('email') }}" required
                                    class="w-full px-4 py-3 pl-10 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-200"
                                    placeholder="vendor@ejemplo.com">
                            </div>
                        </div>
                        
                        <!-- Password -->
                        <div>
                            <label for="password" class="block text-sm font-medium text-neutral-700 mb-2">Contraseña *</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-neutral-400">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 11V7a4 4 0 00-8 0v4m12 0v6a2 2 0 01-2 2H6a2 2 0 01-2-2v-6h12z"></path>
                                    </svg>
                                </span>
                                <input type="password" id="password" name="password" required
                                    class="w-full px-4 py-3 pl-10 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-200"
                                    placeholder="••••••••">
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-2 gap-4">
                            <!-- Direction -->
                            <div>
                                <label for="direction" class="block text-sm font-medium text-neutral-700 mb-2">Dirección</label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-neutral-400">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                    </span>
                                    <input type="text" id="direction" name="direction" value="{{ old('direction') }}"
                                        class="w-full px-4 py-3 pl-10 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-200"
                                        placeholder="Av. Principal 123">
                                </div>
                            </div>
                            
                            <!-- Phone -->
                            <div>
                                <label for="phone_number" class="block text-sm font-medium text-neutral-700 mb-2">Teléfono</label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-neutral-400">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 00-.96.6l-1.36 2.55a1 1 0 00.26 1.38A6 6 0 0021 12a6 6 0 01-9.92 5.47 1 1 0 00-1.38-.26l-2.55 1.36A1 1 0 005.72 19H5a2 2 0 01-2-2V5z"></path>
                                        </svg>
                                    </span>
                                    <input type="tel" id="phone_number" name="phone_number" value="{{ old('phone_number') }}"
                                        class="w-full px-4 py-3 pl-10 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-200"
                                        placeholder="0991234567">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Store Info Section -->
                <div>
                    <h3 class="text-lg font-bold text-neutral-800 mb-6 pb-2 border-b border-neutral-200">Información de la Tienda</h3>
                    
                    <div class="space-y-5">
                        <!-- Store Name -->
                        <div>
                            <label for="store_name" class="block text-sm font-medium text-neutral-700 mb-2">Nombre de la Tienda *</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-neutral-400">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21H5a2 2 0 01-2-2V5a2 2 0 012-2h11l5 5v11a2 2 0 01-2 2z"></path>
                                    </svg>
                                </span>
                                <input type="text" id="store_name" name="store_name" value="{{ old('store_name') }}" required
                                    class="w-full px-4 py-3 pl-10 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-200"
                                    placeholder="Tech Store">
                            </div>
                        </div>
                        
                        <!-- Store Description -->
                        <div>
                            <label for="store_description" class="block text-sm font-medium text-neutral-700 mb-2">Descripción de la Tienda</label>
                            <textarea id="store_description" name="store_description" rows="3"
                                class="w-full px-4 py-3 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-200 resize-none"
                                placeholder="Describe tu tienda y los productos que vendes...">{{ old('store_description') }}</textarea>
                        </div>
                        
                        <!-- Store Logo -->
                        <div>
                            <label for="store_logo" class="block text-sm font-medium text-neutral-700 mb-2">URL del Logo</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-neutral-400">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </span>
                                <input type="url" id="store_logo" name="store_logo" value="{{ old('store_logo') }}"
                                    class="w-full px-4 py-3 pl-10 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-200"
                                    placeholder="https://ejemplo.com/logo.png">
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Submit Button -->
                <button type="submit" class="w-full py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-md font-semibold shadow-sm">
                    CREAR MI TIENDA
                </button>
            </form>
            
            <!-- Divider -->
            <div class="flex items-center my-6">
                <div class="flex-1 h-px bg-neutral-200"></div>
                <div class="px-4 text-xs text-neutral-500">o</div>
                <div class="flex-1 h-px bg-neutral-200"></div>
            </div>
            
            <!-- Links -->
            <div class="text-center">
                <p class="text-sm text-neutral-500">
                    ¿Ya tienes cuenta? 
                    <a href="{{ route('auth.login.show') }}" class="text-blue-600 font-medium hover:underline">
                        Iniciar Sesión
                    </a>
                </p>
            </div>
        </div>
    </div>
</section>
@endsection
