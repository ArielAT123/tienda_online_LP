<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Tienda Online') - {{ config('app.name') }}</title>
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        // Corporate Color Palette
                        chocolate: {
                            DEFAULT: '#3D2B1F',
                            light: '#5A4332',
                            dark: '#2A1D15',
                        },
                        accent: {
                            DEFAULT: '#FF6600',
                            light: '#FF8533',
                            dark: '#CC5200',
                        },
                        neutral: {
                            50: '#FAFAFA',
                            100: '#F5F5F5',
                            200: '#E5E5E5',
                            300: '#D4D4D4',
                            400: '#A3A3A3',
                            500: '#737373',
                            600: '#525252',
                            700: '#404040',
                            800: '#262626',
                            900: '#171717',
                        }
                    },
                    fontFamily: {
                        sans: ['Inter', 'Roboto', 'system-ui', 'sans-serif'],
                    },
                    borderRadius: {
                        'none': '0px',
                    }
                }
            }
        }
    </script>
    
    <!-- Google Fonts - Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Corporate Minimalist Styles -->
    <style>
        * {
            border-radius: 0 !important;
        }
        
        body {
            font-family: 'Inter', 'Roboto', system-ui, sans-serif;
            background-color: #FAFAFA;
            color: #404040;
        }
        
        /* Typography */
        h1, h2, h3, h4, h5, h6 {
            font-weight: 700;
            letter-spacing: -0.02em;
        }
        
        p {
            line-height: 1.75;
        }
        
        /* Corporate Card */
        .corp-card {
            background: #FFFFFF;
            border: 1px solid #E5E5E5;
            transition: border-color 0.2s ease;
        }
        
        .corp-card:hover {
            border-color: #3D2B1F;
        }
        
        /* Chocolate Background */
        .bg-chocolate-section {
            background-color: #3D2B1F;
            color: #FFFFFF;
        }
        
        /* Primary Button - Orange */
        .btn-accent {
            background-color: #FF6600;
            color: #FFFFFF;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            transition: background-color 0.2s ease;
            border: none;
        }
        
        .btn-accent:hover {
            background-color: #CC5200;
        }
        
        /* Secondary Button - Chocolate */
        .btn-chocolate {
            background-color: #3D2B1F;
            color: #FFFFFF;
            font-weight: 600;
            transition: background-color 0.2s ease;
            border: none;
        }
        
        .btn-chocolate:hover {
            background-color: #2A1D15;
        }
        
        /* Outline Button */
        .btn-outline {
            background-color: transparent;
            color: #3D2B1F;
            font-weight: 600;
            border: 2px solid #3D2B1F;
            transition: all 0.2s ease;
        }
        
        .btn-outline:hover {
            background-color: #3D2B1F;
            color: #FFFFFF;
        }
        
        /* Input Field */
        .input-corp {
            background: #FFFFFF;
            border: 1px solid #D4D4D4;
            color: #262626;
            transition: border-color 0.2s ease;
        }
        
        .input-corp:focus {
            outline: none;
            border-color: #FF6600;
        }
        
        .input-corp::placeholder {
            color: #A3A3A3;
        }
        
        /* Navigation Link */
        .nav-corp {
            color: #525252;
            font-weight: 500;
            position: relative;
            transition: color 0.2s ease;
        }
        
        .nav-corp:hover {
            color: #FF6600;
        }
        
        .nav-corp::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 2px;
            background-color: #FF6600;
            transition: width 0.2s ease;
        }
        
        .nav-corp:hover::after {
            width: 100%;
        }
        
        /* Icon Container */
        .icon-box {
            width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid #E5E5E5;
        }
        
        /* Section Divider */
        .divider {
            height: 1px;
            background-color: #E5E5E5;
        }
        
        /* Tag Badge */
        .tag-badge {
            background-color: #3D2B1F;
            color: #FFFFFF;
            font-size: 0.75rem;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }
    </style>
    
    @stack('styles')
</head>
<body class="min-h-screen bg-neutral-50">
    <!-- Navigation -->
    <nav class="bg-white border-b border-neutral-200 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <!-- Logo -->
                <a href="{{ route('home') }}" class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-accent flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                    </div>
                    <span class="text-xl font-bold text-chocolate">TIENDA</span>
                </a>
                
                <!-- Desktop Navigation -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('home') }}" class="nav-corp">Inicio</a>
                    <a href="{{ route('products.tags') }}" class="nav-corp">Categorías</a>
                    <a href="{{ route('cart.index') }}" class="nav-corp flex items-center">
                        <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        Carrito
                    </a>
                </div>
                
                <!-- Auth Buttons -->
                <div class="hidden md:flex items-center space-x-4">
                    @if(session('api_token'))
                        <a href="{{ route('users.show') }}" class="text-neutral-600 font-medium flex items-center hover:underline">
                            <svg class="w-5 h-5 mr-2 text-chocolate" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            {{ session('user_name', 'Usuario') }}
                        </a>
                        @if(session('is_vendor'))
                        <a href="{{ route('products.add') }}" class="text-accent font-medium hover:text-accent-dark">
                            + Producto
                        </a>
                        @endif
                        <form action="{{ route('auth.logout') }}" method="POST" class="inline ml-4">
                            @csrf
                            <button type="submit" class="text-neutral-600 hover:text-red-600 font-medium">
                                Cerrar sesión
                            </button>
                        </form>
                    @else
                        <a href="{{ route('auth.login.show') }}" class="nav-corp">Ingresar</a>
                        <a href="{{ route('auth.register-vendor') }}" class="btn-accent px-5 py-2">
                            Ser Vendedor
                        </a>
                    @endif
                </div>
                
                <!-- Mobile menu button -->
                <button id="mobile-menu-btn" class="md:hidden p-2 text-neutral-600 hover:text-chocolate">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>
        
        <!-- Mobile Navigation -->
        <div id="mobile-menu" class="hidden md:hidden bg-white border-t border-neutral-200">
            <div class="px-4 py-4 space-y-3">
                <a href="{{ route('home') }}" class="block text-neutral-600 hover:text-chocolate font-medium py-2">Inicio</a>
                <a href="{{ route('products.tags') }}" class="block text-neutral-600 hover:text-chocolate font-medium py-2">Categorías</a>
                <a href="{{ route('cart.index') }}" class="block text-neutral-600 hover:text-chocolate font-medium py-2">Carrito</a>
                <div class="divider my-3"></div>
                @if(session('api_token'))
                    <a href="{{ route('users.show') }}" class="block text-neutral-500 py-2 hover:underline">{{ session('user_name', 'Usuario') }}</a>
                    @if(session('is_vendor'))
                    <a href="{{ route('products.add') }}" class="block text-accent font-medium py-2">+ Agregar Producto</a>
                    @endif
                    <form action="{{ route('auth.logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="block w-full text-left text-red-600 font-medium py-2">Cerrar Sesión</button>
                    </form>
                @else
                    <a href="{{ route('auth.login.show') }}" class="block text-neutral-600 hover:text-chocolate font-medium py-2">Ingresar</a>
                    <a href="{{ route('auth.register-client') }}" class="block text-neutral-600 hover:text-chocolate font-medium py-2">Registrarse</a>
                    <a href="{{ route('auth.register-vendor') }}" class="block btn-accent px-4 py-2 text-center mt-2">Ser Vendedor</a>
                @endif
            </div>
        </div>
    </nav>
    
    <!-- Flash Messages -->
    @if(session('success'))
    <div class="bg-green-50 border-l-4 border-green-500 p-4 mx-4 mt-4 max-w-7xl lg:mx-auto">
        <div class="flex items-center">
            <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
            <span class="text-green-800">{{ session('success') }}</span>
        </div>
    </div>
    @endif

    @if(session('info'))
    <div class="bg-blue-50 border-l-4 border-blue-500 p-4 mx-4 mt-4 max-w-7xl lg:mx-auto">
        <div class="flex items-center">
            <svg class="w-5 h-5 text-blue-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M12 20a8 8 0 100-16 8 8 0 000 16z"></path>
            </svg>
            <span class="text-blue-800">{{ session('info') }}</span>
        </div>
    </div>
    @endif
    
    @if($errors->any())
    <div class="bg-red-50 border-l-4 border-red-500 p-4 mx-4 mt-4 max-w-7xl lg:mx-auto">
        <ul class="text-red-800">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    
    <!-- Main Content -->
    <main>
        @yield('content')
    </main>
    
    <!-- Footer -->
    <footer class="bg-chocolate-section mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12">
                <!-- Brand -->
                <div class="col-span-1 md:col-span-2">
                    <div class="flex items-center space-x-3 mb-6">
                        <div class="w-10 h-10 bg-accent flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                        </div>
                        <span class="text-xl font-bold text-white">TIENDA</span>
                    </div>
                    <p class="text-neutral-300 max-w-sm leading-relaxed">
                        Tu marketplace de confianza. Conectamos vendedores y compradores para crear experiencias de compra excepcionales.
                    </p>
                </div>
                
                <!-- Navigation -->
                <div>
                    <h3 class="text-white font-bold text-sm uppercase tracking-wider mb-6">Navegación</h3>
                    <ul class="space-y-3">
                        <li><a href="{{ route('home') }}" class="text-neutral-300 hover:text-accent transition-colors">Inicio</a></li>
                        <li><a href="{{ route('products.tags') }}" class="text-neutral-300 hover:text-accent transition-colors">Categorías</a></li>
                        <li><a href="{{ route('cart.index') }}" class="text-neutral-300 hover:text-accent transition-colors">Carrito</a></li>
                    </ul>
                </div>
                
                <!-- Account -->
                <div>
                    <h3 class="text-white font-bold text-sm uppercase tracking-wider mb-6">Cuenta</h3>
                    <ul class="space-y-3">
                        @if(session('api_token'))
                        <li><a href="{{ route('users.show') }}" class="text-neutral-300 hover:text-accent transition-colors">Mi Perfil</a></li>
                        <li>
                            <form method="POST" action="{{ route('auth.logout') }}">
                                @csrf
                                <button type="submit" class="text-neutral-300 hover:text-accent transition-colors">Cerrar sesión</button>
                            </form>
                        </li>
                        @else
                        <li><a href="{{ route('auth.login.show') }}" class="text-neutral-300 hover:text-accent transition-colors">Ingresar</a></li>
                        <li><a href="{{ route('auth.register-client') }}" class="text-neutral-300 hover:text-accent transition-colors">Registrarse</a></li>
                        <li><a href="{{ route('auth.register-vendor') }}" class="text-neutral-300 hover:text-accent transition-colors">Ser Vendedor</a></li>
                        @endif
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-white/10 mt-12 pt-8">
                <p class="text-neutral-400 text-sm text-center">&copy; {{ date('Y') }} TIENDA. Todos los derechos reservados.</p>
            </div>
        </div>
    </footer>
    
    <!-- Mobile Menu Script -->
    <script>
        document.getElementById('mobile-menu-btn').addEventListener('click', function() {
            document.getElementById('mobile-menu').classList.toggle('hidden');
        });
        
        // Auto-hide flash messages
        setTimeout(() => {
            const alerts = document.querySelectorAll('.bg-green-50, .bg-red-50');
            alerts.forEach(alert => {
                alert.style.opacity = '0';
                alert.style.transition = 'opacity 0.5s ease';
                setTimeout(() => alert.remove(), 500);
            });
        }, 5000);
    </script>
    
    @stack('scripts')
</body>
</html>
