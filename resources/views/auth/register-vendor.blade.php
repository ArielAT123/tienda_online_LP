@extends('layouts.app')

@section('title', 'Registro de Vendedor')

@section('content')
<!-- Header -->
<section class="bg-chocolate-section py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <p class="text-accent font-medium uppercase tracking-wider mb-2">Únete</p>
        <h1 class="text-4xl font-bold text-white">Convertirse en Vendedor</h1>
        <p class="text-neutral-300 mt-2">Abre tu tienda y empieza a vender hoy</p>
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
                            <input type="text" id="name" name="name" value="{{ old('name') }}" required
                                class="input-corp w-full px-4 py-3"
                                placeholder="Carlos García">
                        </div>
                        
                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-neutral-700 mb-2">Correo Electrónico *</label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" required
                                class="input-corp w-full px-4 py-3"
                                placeholder="vendor@ejemplo.com">
                        </div>
                        
                        <!-- Password -->
                        <div>
                            <label for="password" class="block text-sm font-medium text-neutral-700 mb-2">Contraseña *</label>
                            <input type="password" id="password" name="password" required
                                class="input-corp w-full px-4 py-3"
                                placeholder="••••••••">
                        </div>
                        
                        <div class="grid grid-cols-2 gap-4">
                            <!-- Direction -->
                            <div>
                                <label for="direction" class="block text-sm font-medium text-neutral-700 mb-2">Dirección *</label>
                                <input type="text" id="direction" name="direction" value="{{ old('direction') }}" required
                                    class="input-corp w-full px-4 py-3"
                                    placeholder="Av. Principal 123">
                            </div>
                            
                            <!-- Phone -->
                            <div>
                                <label for="phone_number" class="block text-sm font-medium text-neutral-700 mb-2">Teléfono *</label>
                                <input type="tel" id="phone_number" name="phone_number" value="{{ old('phone_number') }}" required
                                    class="input-corp w-full px-4 py-3"
                                    placeholder="0991234567">
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
                            <label for="store_name" class="block text-sm font-medium text-neutral-700 mb-2">Nombre de la Tienda (opcional)</label>
                            <input type="text" id="store_name" name="store_name" value="{{ old('store_name') }}"
                                class="input-corp w-full px-4 py-3"
                                placeholder="Dejar vacío para usar tu nombre">
                        </div>
                        
                        <!-- Store Description -->
                        <div>
                            <label for="store_description" class="block text-sm font-medium text-neutral-700 mb-2">Descripción de la Tienda</label>
                            <textarea id="store_description" name="store_description" rows="3"
                                class="input-corp w-full px-4 py-3 resize-none"
                                placeholder="Describe tu tienda y los productos que vendes...">{{ old('store_description') }}</textarea>
                        </div>
                        
                        <!-- Store Logo -->
                        <div>
                            <label for="store_logo" class="block text-sm font-medium text-neutral-700 mb-2">URL del Logo</label>
                            <input type="url" id="store_logo" name="store_logo" value="{{ old('store_logo') }}"
                                class="input-corp w-full px-4 py-3"
                                placeholder="https://ejemplo.com/logo.png">
                        </div>
                    </div>
                </div>
                
                <!-- Submit Button -->
                <button type="submit" class="btn-accent w-full py-4 font-bold">
                    CREAR MI TIENDA
                </button>
            </form>
            
            <!-- Divider -->
            <div class="divider my-8"></div>
            
            <!-- Links -->
            <div class="text-center space-y-3">
                <p class="text-neutral-500">
                    ¿Ya tienes cuenta? 
                    <a href="{{ route('auth.login.show') }}" class="text-accent font-medium hover:underline">
                        Iniciar Sesión
                    </a>
                </p>
                <p class="text-neutral-500">
                    ¿Solo quieres comprar? 
                    <a href="{{ route('auth.register-client') }}" class="text-chocolate font-medium hover:underline">
                        Regístrate como cliente
                    </a>
                </p>
            </div>
        </div>
    </div>
</section>
@endsection
