<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $globalSettings->site_title ?? 'Slope' }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Inter:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#3819e7', // New Slope Primary Color
                        secondary: '#1e293b',
                        accent: '#facc15', // Yellow/Gold
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        display: ['Outfit', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        .glass {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .dropdown:hover .dropdown-menu {
            display: block;
        }

        .dropdown-menu {
            display: none;
            position: absolute;
            z-index: 100;
        }

        .text-gradient {
            background: linear-gradient(135deg, #3819e7 0%, #7c3aed 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .fade-up {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1);
        }

        .fade-up.visible {
            opacity: 1;
            transform: translateY(0);
        }

        body {
            font-feature-settings: "cv02", "cv03", "cv04", "cv11";
        }

        h1,
        h2,
        h3,
        h4 {
            font-family: 'Outfit', sans-serif;
        }

        .soft-shadow {
            box-shadow: 0 10px 30px -5px rgba(56, 25, 231, 0.1), 0 4px 10px -2px rgba(56, 25, 231, 0.05);
        }
    </style>
</head>

<body class="font-sans text-slate-700 antialiased bg-white flex flex-col min-h-screen">

    <!-- Top Bar -->
    <div class="bg-primary text-white text-sm py-2 hidden md:block border-b border-blue-600">
        <div class="container mx-auto px-4 flex justify-between items-center">
            <div class="flex items-center gap-6">
                <span>📞 {{ $globalSettings->phone ?? '+880 1913 662 687' }}</span>
                <span>✉️ {{ $globalSettings->email ?? 'contact@slope.com' }}</span>
            </div>
            <div class="flex items-center gap-4">
                <a href="#" class="hover:text-accent transition-colors">Sign In</a>
                <span>|</span>
                <a href="#" class="hover:text-accent transition-colors">Register</a>
            </div>
        </div>
    </div>

    <!-- Main Header -->
    <header class="glass sticky top-0 z-50 transition-all duration-300">
        <div class="container mx-auto px-4 h-20 flex items-center justify-between">
            <!-- Logo -->
            <a href="{{ route('home') }}" class="flex items-center gap-2">
                <img src="{{ asset('storage/' . $globalSettings->logo) }}" alt="Slope Logo" class="h-10">
                {{-- <span class="text-3xl font-bold text-primary tracking-tight">Slope M</span> --}}
            </a>

            <!-- Desktop Navigation -->
            <nav class="hidden lg:flex items-center gap-6 font-medium text-slate-600">
                <a href="{{ route('home') }}"
                    class="hover:text-primary transition-colors py-2 {{ request()->routeIs('home') ? 'text-primary border-b-2 border-primary' : '' }}">Home</a>

                {{-- About Us Dropdown --}}
                <div class="relative dropdown group py-2">
                    <button class="flex items-center gap-1 hover:text-primary transition-colors {{ request()->routeIs('about*') ? 'text-primary border-b-2 border-primary' : '' }}">
                        About Us
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transition-transform group-hover:rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div class="dropdown-menu pt-4 w-48 left-0">
                        <div class="glass rounded-2xl shadow-xl border border-slate-100 overflow-hidden py-2 soft-shadow">
                            <a href="{{ route('about.md_message') }}" class="block px-6 py-3 text-sm hover:bg-primary/5 hover:text-primary transition-all">MD</a>
                            <a href="{{ route('about.team') }}" class="block px-6 py-3 text-sm hover:bg-primary/5 hover:text-primary transition-all">Team</a>
                            <a href="{{ route('about.clients') }}" class="block px-6 py-3 text-sm hover:bg-primary/5 hover:text-primary transition-all">Our Client</a>
                        </div>
                    </div>
                </div>

                {{-- Products Dropdown --}}
                <div class="relative dropdown group py-2">
                    <button class="flex items-center gap-1 hover:text-primary transition-colors {{ request()->routeIs('products.*') ? 'text-primary border-b-2 border-primary' : '' }}">
                        Products
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transition-transform group-hover:rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div class="dropdown-menu pt-4 w-56 left-0">
                        <div class="glass rounded-2xl shadow-xl border border-slate-100 overflow-hidden py-2 soft-shadow">
                            @php $navCategories = \App\Models\Category::whereNull('parent_id')->with('children')->orderBy('name')->get(); @endphp
                            @foreach($navCategories as $navCat)
                                @if($navCat->children->count())
                                    <div class="relative dropdown-sub group/sub">
                                        <a href="{{ route('products.index', ['category' => $navCat->slug ?? $navCat->id]) }}" class="flex items-center justify-between px-6 py-3 text-sm hover:bg-primary/5 hover:text-primary transition-all">
                                            {{ $navCat->name }}
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                                        </a>
                                        <div class="hidden group-hover/sub:block absolute left-full top-0 w-48">
                                            <div class="ml-1 glass rounded-2xl shadow-xl border border-slate-100 overflow-hidden py-2 soft-shadow">
                                                @foreach($navCat->children as $child)
                                                    <a href="{{ route('products.index', ['category' => $child->slug ?? $child->id]) }}" class="block px-6 py-3 text-sm hover:bg-primary/5 hover:text-primary transition-all">{{ $child->name }}</a>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <a href="{{ route('products.index', ['category' => $navCat->slug ?? $navCat->id]) }}" class="block px-6 py-3 text-sm hover:bg-primary/5 hover:text-primary transition-all">{{ $navCat->name }}</a>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>

                <a href="{{ route('services') }}" class="hover:text-primary transition-colors py-2 {{ request()->routeIs('services*') ? 'text-primary border-b-2 border-primary' : '' }}">Services</a>

                <a href="{{ route('contact') }}" class="hover:text-primary transition-colors py-2 {{ request()->routeIs('contact') ? 'text-primary border-b-2 border-primary' : '' }}">Contact Us</a>

                <a href="{{ route('contact') }}?subject=Quotation" class="px-5 py-2 bg-accent text-slate-900 rounded font-semibold hover:bg-yellow-400 transition-colors shadow-lg shadow-yellow-200 whitespace-nowrap">Ask For Quotation</a>
            </nav>

            <!-- Mobile Menu Button -->
            <button class="lg:hidden text-slate-900">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                </svg>
            </button>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-primary text-white pt-16 pb-8 border-t-4 border-accent">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                <!-- About -->
                <div>
                    <h3 class="text-xl font-bold mb-6">About Us</h3>
                    <p class="text-blue-100 leading-relaxed mb-6 text-sm text-justify">
                        {{ \Illuminate\Support\Str::limit($globalSettings->site_description ?? 'Slope Medical Solution is an ISO Certified Medical Equipment Importer, Supplier, and Service Provider Company. Our mission is to provide an exceptional range of high-quality products for the remarkable benefit of our valued customers.', 220) }}
                    </p>
                    <div class="flex gap-3">
                        <a href="#" class="w-8 h-8 rounded-full bg-accent hover:bg-yellow-300 text-slate-900 flex items-center justify-center transition-all text-xs font-bold">f</a>
                        <a href="#" class="w-8 h-8 rounded-full bg-accent hover:bg-yellow-300 text-slate-900 flex items-center justify-center transition-all text-xs font-bold">t</a>
                        <a href="#" class="w-8 h-8 rounded-full bg-accent hover:bg-yellow-300 text-slate-900 flex items-center justify-center transition-all text-xs font-bold">g+</a>
                        <a href="#" class="w-8 h-8 rounded-full bg-accent hover:bg-yellow-300 text-slate-900 flex items-center justify-center transition-all text-xs font-bold">in</a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div>
                    <h3 class="text-xl font-bold mb-6 pl-3 border-l-4 border-accent">Quick Link</h3>
                    <ul class="space-y-3 text-blue-100 text-sm">
                        <li><a href="{{ route('about') }}" class="hover:text-accent transition-colors flex items-center gap-2"><span class="text-accent">›</span> About Us</a></li>
                        <li><a href="{{ route('about.md_message') }}" class="hover:text-accent transition-colors flex items-center gap-2"><span class="text-accent">›</span> Message From Managing Director</a></li>
                        <li><a href="{{ route('contact') }}" class="hover:text-accent transition-colors flex items-center gap-2"><span class="text-accent">›</span> Our Branches</a></li>
                    </ul>
                </div>

                <!-- Location -->
                <div>
                    <h3 class="text-xl font-bold mb-6 pl-3 border-l-4 border-accent">Location</h3>
                    <ul class="space-y-4 text-blue-100 text-sm">
                        <li class="flex gap-3 items-start">
                            <span class="text-accent mt-1">📍</span>
                            <span>{{ $globalSettings->address ?? 'Corporate Office: 59/D-A Darussalam Tower, Darussalam, Dhaka' }}</span>
                        </li>
                        <li class="flex gap-3 items-center">
                            <span class="text-accent">✉️</span>
                            <a href="mailto:{{ $globalSettings->email }}" class="hover:text-white">{{
                                $globalSettings->email ?? 'contact@slope.com' }}</a>
                        </li>
                        <li class="flex gap-3 items-center">
                            <span class="text-accent">📞</span>
                            <span>{{ $globalSettings->phone ?? '+880 1913 662 687' }}</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-blue-400 mt-12 pt-8 text-center text-blue-200 text-sm">
                <p>&copy; {{ date('Y') }} <span class="font-bold text-white">Slope</span>. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        // Animation Engine
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, observerOptions);

        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('.fade-up').forEach(el => observer.observe(el));
        });
    </script>
</body>

</html>