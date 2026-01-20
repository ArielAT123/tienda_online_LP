@extends('layouts.app')

@section('title', $user['name'] ?? 'Perfil')

@section('content')
<section class="py-16 px-4 bg-blue-50">
    <div class="max-w-4xl mx-auto">
        <div class="bg-white border border-neutral-200 p-8">
            <div class="text-center mb-6">
                <p class="text-blue-600 font-medium uppercase tracking-wider mb-2">Perfil</p>
                <h1 class="text-2xl font-bold text-neutral-800">{{ $user['name'] ?? 'Usuario' }}</h1>
                <p class="text-neutral-500 mt-1">Información de la cuenta</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <div class="lg:col-span-2">
                    <div class="bg-white border border-neutral-200 p-6">
                        <h3 class="text-lg font-bold text-neutral-800 mb-4">Datos</h3>

                        <div class="space-y-4">
                            <div class="flex items-center gap-4 p-4 bg-neutral-50 border border-neutral-200">
                                <div class="w-12 h-12 bg-blue-600 flex items-center justify-center text-white rounded">{{ strtoupper(substr($user['name'] ?? 'U', 0, 1)) }}</div>
                                <div>
                                    <p class="text-xs text-neutral-400 uppercase tracking-wider">Nombre</p>
                                    <p class="text-neutral-800 font-medium">{{ $user['name'] ?? '-' }}</p>
                                </div>
                            </div>

                            <div class="flex items-center gap-4 p-4 bg-neutral-50 border border-neutral-200">
                                <div class="icon-box flex-shrink-0">
                                    <svg class="w-5 h-5 text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs text-neutral-400 uppercase tracking-wider">Email</p>
                                    <p class="text-neutral-800 font-medium">{{ $user['email'] ?? '-' }}</p>
                                </div>
                            </div>

                            @if(isset($user['phone_number']) && $user['phone_number'])
                            <div class="flex items-center gap-4 p-4 bg-neutral-50 border border-neutral-200">
                                <div class="icon-box flex-shrink-0">
                                    <svg class="w-5 h-5 text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs text-neutral-400 uppercase tracking-wider">Teléfono</p>
                                    <p class="text-neutral-800 font-medium">{{ $user['phone_number'] }}</p>
                                </div>
                            </div>
                            @endif

                            @if(isset($user['direction']) && $user['direction'])
                            <div class="flex items-center gap-4 p-4 bg-neutral-50 border border-neutral-200">
                                <div class="icon-box flex-shrink-0">
                                    <svg class="w-5 h-5 text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs text-neutral-400 uppercase tracking-wider">Dirección</p>
                                    <p class="text-neutral-800 font-medium">{{ $user['direction'] }}</p>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-1">
                    <div class="bg-white border border-neutral-200 p-6 sticky top-24">
                        <h3 class="text-sm font-bold text-neutral-800 uppercase tracking-wider mb-6">Opciones</h3>
                        <div class="space-y-4">
                            @unless(session('is_vendor'))
                            <a href="{{ route('auth.register-vendor') }}" class="inline-block px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-md font-semibold shadow-sm text-center mx-auto mt-2">Ser vendedor</a>
                            @endunless

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
