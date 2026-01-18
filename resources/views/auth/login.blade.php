@extends('layouts.app')

@section('title', 'Iniciar Sesión')

@section('content')
<section class="min-h-[80vh] flex items-center justify-center py-16 px-4 bg-neutral-50">
    <div class="w-full max-w-md">
        <div class="bg-white border border-neutral-200 p-8">
            <!-- Header -->
            <div class="text-center mb-6">
                <h1 class="text-3xl font-extrabold text-blue-600">Ingresar</h1>
                <h2 class="text-xl font-semibold text-neutral-800 mt-6">Iniciar Sesión</h2>
            </div>

            <!-- Form -->
            <form method="POST" action="{{ route('auth.login') }}" class="space-y-4">
                @csrf

                <div>
                    <label for="email" class="block text-sm font-medium text-neutral-700 mb-2">Email *</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-neutral-400">
                            {{-- mail icon --}}
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.5 5L18 8m1-1H3a2 2 0 00-2 2v8a2 2 0 002 2h18a2 2 0 002-2V9a2 2 0 00-2-2z"></path>
                            </svg>
                        </span>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required
                            class="w-full px-4 py-3 pl-10 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-200"
                            placeholder="tu@email.com">
                    </div>
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-neutral-700 mb-2">Contraseña *</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-neutral-400">
                            {{-- lock icon --}}
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 11V7a4 4 0 00-8 0v4m12 0v6a2 2 0 01-2 2H6a2 2 0 01-2-2v-6h12z"></path>
                            </svg>
                        </span>
                        <input type="password" id="password" name="password" required
                            class="w-full px-4 py-3 pl-10 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-200"
                            placeholder="••••••••">
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <label class="inline-flex items-center text-sm text-neutral-600">
                        <input type="checkbox" name="remember" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-neutral-300 rounded" />
                        <span class="ml-2">Recordarme</span>
                    </label>
                    <a href="#" class="text-sm text-blue-600 hover:underline">¿Olvidaste tu contraseña?</a>
                </div>

                <button type="submit" class="w-full py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-md font-semibold shadow-sm">
                    Iniciar Sesión
                </button>
            </form>

            <!-- Divider -->
            <div class="flex items-center my-6">
                <div class="flex-1 h-px bg-neutral-200"></div>
                <div class="px-4 text-xs text-neutral-500">o continuar con</div>
                <div class="flex-1 h-px bg-neutral-200"></div>
            </div>


            <!-- Footer Links -->
            <div class="text-center mt-6">
                <p class="text-sm text-neutral-500">
                    ¿No tienes una cuenta? 
                    <a href="{{ route('auth.register-client') }}" class="text-blue-600 font-medium hover:underline">Regístrate aquí</a>
                </p>
                <p class="text-sm textneutral-500">
                    ¿Quieres vender? 
                    <a href="{{ route('auth.register-vendor') }}" class="text-blue-600 font-medium hover:underline">
                        Regístrate como vendedor
                    </a>
                </p>
            </div>
        </div>
    </div>
</section>
@endsection
