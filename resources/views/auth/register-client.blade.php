@extends('layouts.app')

@section('title', 'Registro de Cliente')

@section('content')
<section class="min-h-[80vh] flex items-center justify-center py-16 px-4 bg-neutral-50">
    <div class="w-full max-w-md">
        <div class="bg-white border border-neutral-200 p-8">
            <!-- Header -->
            <div class="text-center mb-8">
                <div class="icon-box bg-accent border-accent mx-auto mb-4">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </div>
                <h1 class="text-2xl font-bold text-neutral-800">Crear Cuenta</h1>
                <p class="text-neutral-500 mt-2">Únete a nuestra comunidad</p>
            </div>
            
            <!-- Form -->
            <form method="POST" action="{{ route('auth.register-client.store') }}" class="space-y-5">
                @csrf
                
                <!-- Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-neutral-700 mb-2">Nombre Completo *</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" required
                        class="input-corp w-full px-4 py-3"
                        placeholder="Juan Pérez">
                </div>
                
                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-neutral-700 mb-2">Correo Electrónico *</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required
                        class="input-corp w-full px-4 py-3"
                        placeholder="correo@ejemplo.com">
                </div>
                
                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-neutral-700 mb-2">Contraseña *</label>
                    <input type="password" id="password" name="password" required
                        class="input-corp w-full px-4 py-3"
                        placeholder="••••••••">
                    <p class="text-neutral-400 text-xs mt-1">Mínimo 6 caracteres</p>
                </div>
                
                <!-- Submit Button -->
                <button type="submit" class="btn-accent w-full py-4 font-bold">
                    CREAR CUENTA
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
                    ¿Quieres vender? 
                    <a href="{{ route('auth.register-vendor') }}" class="text-chocolate font-medium hover:underline">
                        Regístrate como vendedor
                    </a>
                </p>
            </div>
        </div>
    </div>
</section>
@endsection
