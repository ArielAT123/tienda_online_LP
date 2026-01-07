@extends('layouts.app')

@section('title', 'Iniciar Sesión')

@section('content')
<section class="min-h-[80vh] flex items-center justify-center py-16 px-4 bg-neutral-50">
    <div class="w-full max-w-md">
        <div class="bg-white border border-neutral-200 p-8">
            <!-- Header -->
            <div class="text-center mb-8">
                <div class="icon-box bg-chocolate border-chocolate mx-auto mb-4">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                    </svg>
                </div>
                <h1 class="text-2xl font-bold text-neutral-800">Iniciar Sesión</h1>
                <p class="text-neutral-500 mt-2">Accede a tu cuenta</p>
            </div>
            
            <!-- Form -->
            <form method="POST" action="{{ route('auth.login') }}" class="space-y-5">
                @csrf
                
                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-neutral-700 mb-2">Correo Electrónico</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required
                        class="input-corp w-full px-4 py-3"
                        placeholder="correo@ejemplo.com">
                </div>
                
                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-neutral-700 mb-2">Contraseña</label>
                    <input type="password" id="password" name="password" required
                        class="input-corp w-full px-4 py-3"
                        placeholder="••••••••">
                </div>
                
                <!-- Submit Button -->
                <button type="submit" class="btn-accent w-full py-4 font-bold">
                    INGRESAR
                </button>
            </form>
            
            <!-- Divider -->
            <div class="divider my-8"></div>
            
            <!-- Links -->
            <div class="text-center space-y-3">
                <p class="text-neutral-500">
                    ¿No tienes cuenta? 
                    <a href="{{ route('auth.register-client') }}" class="text-accent font-medium hover:underline">
                        Regístrate aquí
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
