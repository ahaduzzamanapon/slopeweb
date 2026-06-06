@extends('frontend.layouts.app')

@section('content')

    <!-- Hero Section -->
    <section class="relative bg-slate-900 overflow-hidden min-h-screen flex items-center">
        <!-- Video Background -->
        <div class="absolute inset-0 z-0">
            @if(!empty($settings->hero_video))
                <video autoplay muted loop playsinline class="w-full h-full object-cover">
                    <source src="{{ asset('storage/' . $settings->hero_video) }}" type="video/mp4">
                    <source src="{{ asset('storage/' . $settings->hero_video) }}" type="video/webm">
                </video>
            @elseif(!empty($settings->hero_image))
                <img src="{{ str_starts_with($settings->hero_image, 'http') ? $settings->hero_image : asset('storage/' . $settings->hero_image) }}" alt="Hero Background" class="w-full h-full object-cover">
            @else
                <video autoplay muted loop playsinline class="w-full h-full object-cover">
                    <source src="{{ asset('frontend/videos/hero-video.mp4') }}" type="video/mp4">
                </video>
            @endif
            <div class="absolute inset-0 bg-gradient-to-tr from-slate-900 via-slate-900/40 to-transparent"></div>
        </div>

        <div class="container mx-auto px-4 relative z-10 py-32">
            <div class="max-w-4xl fade-up">
                <h1 class="text-3xl md:text-5xl font-display font-extrabold text-white mb-8 leading-[1.1] tracking-tight">
                    @if(!empty($settings->hero_title))
                        {!! nl2br(e($settings->hero_title)) !!}
                    @else
                        Total <span class="text-gradient">Hospital</span> <br>Solution
                    @endif
                </h1>
                <p class="text-xl md:text-2xl text-slate-300 mb-12 max-w-2xl font-light leading-relaxed">
                    {{ $settings->hero_description ?? 'Elevating healthcare through cutting-edge medical technology and diagnostics. Precision in every device, excellence in every service.' }}
                </p>
                <div class="flex flex-wrap gap-6">
                    <a href="{{ route('contact') }}"
                        class="px-10 py-5 bg-primary text-white rounded-full font-bold hover:bg-opacity-90 transition-all shadow-[0_0_40px_rgba(56,25,231,0.3)] hover:-translate-y-1 transform scale-100 active:scale-95">
                        Get Started
                    </a>
                    <a href="#products"
                        class="px-10 py-5 bg-white/10 text-white rounded-full font-bold hover:bg-white/20 transition-all backdrop-blur-md border border-white/20 hover:-translate-y-1 transform scale-100 active:scale-95">
                        Explore Products
                    </a>
                </div>
            </div>
        </div>

        <!-- Decorative Element -->
        <div class="absolute bottom-0 left-0 w-full h-32 bg-gradient-to-t to-transparent"></div>
    </section>

    {{-- Client Logo Ticker --}}
    @php $tickerClients = \App\Models\Client::where('active', true)->orderBy('order')->get(); @endphp
    @if($tickerClients->count())
    <section class="py-4 bg-white border-y border-slate-100 overflow-hidden">
        <div class="relative flex overflow-x-hidden">
            <div class="flex animate-scroll gap-8 whitespace-nowrap items-center" style="animation: ticker 30s linear infinite;">
                @foreach($tickerClients as $cl)
                <a href="{{ route('about.clients') }}" class="inline-flex flex-col items-center gap-2 px-6 shrink-0 hover:opacity-75 transition-opacity">
                    @if($cl->logo)
                        <img src="{{ \Illuminate\Support\Str::startsWith($cl->logo,'http') ? $cl->logo : asset('storage/'.$cl->logo) }}"
                             alt="{{ $cl->name }}" class="h-12 w-auto object-contain grayscale hover:grayscale-0 transition-all">
                    @endif
                    <span class="text-xs text-slate-500 font-medium">{{ $cl->name }}</span>
                </a>
                @endforeach
                {{-- Duplicate for seamless loop --}}
                @foreach($tickerClients as $cl)
                <a href="{{ route('about.clients') }}" class="inline-flex flex-col items-center gap-2 px-6 shrink-0 hover:opacity-75 transition-opacity">
                    @if($cl->logo)
                        <img src="{{ \Illuminate\Support\Str::startsWith($cl->logo,'http') ? $cl->logo : asset('storage/'.$cl->logo) }}"
                             alt="{{ $cl->name }}" class="h-12 w-auto object-contain grayscale hover:grayscale-0 transition-all">
                    @endif
                    <span class="text-xs text-slate-500 font-medium">{{ $cl->name }}</span>
                </a>
                @endforeach
            </div>
        </div>
        <style>
            @keyframes ticker { 0% { transform: translateX(0); } 100% { transform: translateX(-50%); } }
            .animate-scroll { animation: ticker 30s linear infinite; }
            .animate-scroll:hover { animation-play-state: paused; }
        </style>
    </section>
    @endif

    <!-- Why Choose Us Section -->
    <section class="py-32 bg-white relative overflow-hidden">
        <div class="container mx-auto px-4 relative z-10">
            <div class="text-center mb-20 fade-up">
                <h2 class="text-4xl md:text-5xl font-display font-extrabold text-slate-900 mb-6 tracking-tight">Why Choose
                    <span class="text-gradient">Slope</span>?</h2>
                <p class="text-slate-500 max-w-2xl mx-auto text-lg font-light leading-relaxed">We provide end-to-end
                    solutions for healthcare facilities, ensuring the highest standards of quality and reliability.</p>
                <div class="w-24 h-2 bg-gradient-to-r from-primary to-accent mx-auto mt-8 rounded-full shadow-sm"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                <!-- Premium Quality -->
                <div
                    class="bg-white p-12 rounded-[2.5rem] soft-shadow border border-slate-50 hover:border-primary/20 transition-all duration-500 group fade-up delay-100">
                    <div
                        class="w-20 h-20 bg-primary/5 text-primary rounded-3xl flex items-center justify-center mb-8 text-4xl group-hover:bg-primary group-hover:text-white transition-all transform group-hover:rotate-6 shadow-sm">
                        ⭐
                    </div>
                    <h3 class="text-2xl font-bold text-slate-900 mb-4 font-display">Premium Quality</h3>
                    <p class="text-slate-500 leading-relaxed font-light">We source only the finest medical equipment from
                        world-renowned brands, ensuring long-term durability and precision.</p>
                </div>
                <!-- Expert Support -->
                <div
                    class="bg-white p-12 rounded-[2.5rem] soft-shadow border border-slate-50 hover:border-primary/20 transition-all duration-500 group fade-up delay-200">
                    <div
                        class="w-20 h-20 bg-primary/5 text-primary rounded-3xl flex items-center justify-center mb-8 text-4xl group-hover:bg-primary group-hover:text-white transition-all transform group-hover:-rotate-6 shadow-sm">
                        🛠️
                    </div>
                    <h3 class="text-2xl font-bold text-slate-900 mb-4 font-display">Expert Support</h3>
                    <p class="text-slate-500 leading-relaxed font-light">Our team of certified engineers provides 24/7
                        technical support and maintenance for all installed equipment.</p>
                </div>
                <!-- Trusted Partner -->
                <div
                    class="bg-white p-12 rounded-[2.5rem] soft-shadow border border-slate-50 hover:border-primary/20 transition-all duration-500 group fade-up delay-300">
                    <div
                        class="w-20 h-20 bg-primary/5 text-primary rounded-3xl flex items-center justify-center mb-8 text-4xl group-hover:bg-primary group-hover:text-white transition-all transform group-hover:rotate-6 shadow-sm">
                        🤝
                    </div>
                    <h3 class="text-2xl font-bold text-slate-900 mb-4 font-display">Trusted Partner</h3>
                    <p class="text-slate-500 leading-relaxed font-light">Over 500+ clinics and hospitals trust Slope for
                        their critical medical infrastructure and diagnostic needs.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="py-32 bg-slate-50 relative overflow-hidden">
        <!-- Floating Decorative Circles -->
        <div class="absolute -top-24 -right-24 w-96 h-96 bg-primary/10 rounded-full blur-[100px]"></div>
        <div class="absolute bottom-24 -left-24 w-72 h-72 bg-accent/10 rounded-full blur-[80px]"></div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="max-w-3xl mx-auto text-center mb-16 fade-up">
                <h2 class="text-4xl md:text-5xl font-display font-extrabold text-slate-900 mb-6">Success Stories</h2>
                <div class="w-16 h-1.5 bg-primary rounded-full mb-6 mx-auto"></div>
                <p class="text-slate-500 text-xl font-light leading-relaxed">Hear from the healthcare leaders who have
                    transformed their facilities with Slope Medisolve.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($testimonials ?? [] as $index => $testimonial)
                    <div class="glass p-8 rounded-[2.5rem] relative shadow-2xl border border-white/50 fade-up delay-{{ ($index % 3 + 1) * 100 }} group hover:shadow-primary/5 transition-all duration-700">
                        <div class="absolute top-8 right-8 text-6xl text-primary/5 font-serif group-hover:text-primary/10 transition-colors">"</div>
                        <div class="flex items-center gap-4 mb-6">
                            <div class="w-16 h-16 rounded-xl overflow-hidden shadow-lg transform {{ $index % 2 == 0 ? '-rotate-3' : 'rotate-3' }} group-hover:rotate-0 transition-transform flex-shrink-0">
                                @if($testimonial->avatar)
                                    <img src="{{ str_starts_with($testimonial->avatar, 'http') ? $testimonial->avatar : asset('storage/' . $testimonial->avatar) }}" alt="{{ $testimonial->name }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full bg-primary/10 flex items-center justify-center text-primary text-2xl font-bold">
                                        {{ strtoupper(substr($testimonial->name, 0, 1)) }}
                                    </div>
                                @endif
                            </div>
                            <div>
                                <h4 class="font-bold text-slate-900 text-lg leading-snug">{{ $testimonial->name }}</h4>
                                <p class="text-primary font-medium text-xs mt-0.5">{{ $testimonial->title }}</p>
                                <div class="mt-1 flex text-yellow-500 text-xs tracking-widest gap-0.5">
                                    @for($i = 1; $i <= 5; $i++)
                                        <span class="{{ $i <= $testimonial->rating ? 'opacity-100' : 'opacity-30 text-slate-300' }}">★</span>
                                    @endfor
                                </div>
                            </div>
                        </div>
                        <p class="text-slate-600 text-base italic font-light leading-relaxed">
                            "{{ $testimonial->quote }}"
                        </p>
                    </div>
                @empty
                    <div class="col-span-1 md:col-span-2 lg:col-span-3 border border-dashed border-slate-300 rounded-3xl p-10 text-center text-slate-500 font-light">
                        No success stories found.
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Our Products Section -->
    <section class="py-32 bg-white" id="products">
        <div class="container mx-auto px-4">
            <div class="text-center mb-20 fade-up">
                <h2 class="text-4xl md:text-5xl font-display font-extrabold text-slate-900 mb-6 tracking-tight">
                    Our <span class="text-gradient">Premium</span> Products
                </h2>
                <p class="text-slate-500 max-w-2xl mx-auto text-xl font-light leading-relaxed">
                    Reliable, high-performance medical and diagnostic equipment tailored for the modern healthcare facility.
                </p>
                <div class="w-24 h-2 bg-gradient-to-r from-primary to-accent mx-auto mt-10 rounded-full shadow-sm"></div>
            </div>

            <!-- Categories Filter -->
            <div class="flex flex-wrap justify-center gap-3 mb-16">
                <button
                    class="px-8 py-3 rounded-full bg-primary text-white font-bold shadow-lg shadow-primary/20 transition-all hover:-translate-y-0.5 active:scale-95">
                    All Products
                </button>
                @foreach($globalCategories->where('parent_id', null) as $category)
                    <button
                        class="px-8 py-3 rounded-full bg-slate-50 text-slate-600 hover:bg-white hover:text-primary hover:shadow-md transition-all font-bold border border-slate-200">
                        {{ $category->name }}
                    </button>
                @endforeach
            </div>

            <!-- Product Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                @foreach($featuredProducts as $product)
                    <div
                        class="group bg-white rounded-2xl overflow-hidden border border-slate-100 hover:border-primary/20 hover:shadow-2xl hover:shadow-primary/5 transition-all duration-500">
                        <!-- Product Image Wrapper -->
                        <div class="relative h-64 bg-slate-50/50 flex items-center justify-center p-8 overflow-hidden">
                            @php
                                $imageUrl = $product->image;
                                if ($imageUrl && !str_starts_with($imageUrl, 'http')) {
                                    $imageUrl = asset('storage/' . $imageUrl);
                                } elseif (!$imageUrl) {
                                    $imageUrl = 'https://placehold.co/400x400?text=No+Image';
                                }
                            @endphp
                            <img src="{{ $imageUrl }}" alt="{{ $product->title }}"
                                class="max-h-full max-w-full object-contain transition-transform duration-700 group-hover:scale-110 drop-shadow-xl">

                            <!-- Hover Overlay -->
                            <div class="absolute inset-0 bg-primary/0 group-hover:bg-primary/5 transition-colors duration-500">
                            </div>

                            <!-- Quick View Pulse (Optional Decor) -->
                            <div class="absolute top-4 right-4 opacity-0 group-hover:opacity-100 transition-opacity">
                                <span class="flex h-3 w-3">
                                    <span
                                        class="animate-ping absolute inline-flex h-full w-full rounded-full bg-primary opacity-75"></span>
                                    <span class="relative inline-flex rounded-full h-3 w-3 bg-primary"></span>
                                </span>
                            </div>
                        </div>

                        <!-- Product Content -->
                        <div class="p-6">
                            <div class="flex items-center gap-2 mb-3">
                                <span
                                    class="px-2 py-0.5 bg-primary/10 text-primary text-[10px] font-bold uppercase tracking-wider rounded">
                                    {{ $product->category->name ?? 'Medical' }}
                                </span>
                            </div>
                            <h3
                                class="font-bold text-slate-900 text-lg mb-4 line-clamp-2 group-hover:text-primary transition-colors h-14">
                                <a href="{{ route('products.show', $product->slug) }}">{{ $product->title }}</a>
                            </h3>

                            <div class="pt-4 border-t border-slate-50 flex items-center justify-between">
                                <a href="{{ route('products.show', $product->slug) }}"
                                    class="text-primary font-bold text-sm flex items-center gap-1 hover:gap-2 transition-all">
                                    View Details <span class="text-lg">→</span>
                                </a>
                                <button class="p-2 text-slate-400 hover:text-primary transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- View All CTA -->
            <div class="mt-20 text-center">
                <a href="{{ route('products.index') }}"
                    class="inline-flex items-center gap-3 px-10 py-4 bg-slate-900 text-white font-bold rounded-xl hover:bg-primary hover:shadow-xl hover:shadow-primary/20 transition-all group">
                    View All Products
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 group-hover:translate-x-1 transition-transform"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                </a>
            </div>
        </div>
    </section>


    <!-- Our Clients Section -->
    @if(isset($clients) && $clients->count())
    <section class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12 fade-up">
                <h2 class="text-3xl md:text-4xl font-display font-extrabold text-slate-900 mb-4">
                    Our <span class="text-gradient">Trusted Clients</span>
                </h2>
                <div class="w-20 h-2 bg-gradient-to-r from-primary to-accent mx-auto mt-4 rounded-full"></div>
            </div>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6 max-w-5xl mx-auto">
                @foreach($clients as $index => $client)
                <div class="bg-slate-50 rounded-2xl p-5 flex flex-col items-center justify-center border border-slate-100 hover:border-primary/20 hover:shadow-lg hover:-translate-y-1 transition-all duration-400 group fade-up"
                    style="transition-delay: {{ $index * 50 }}ms">
                    <div class="w-16 h-16 rounded-full bg-white border border-slate-200 flex items-center justify-center mb-3 overflow-hidden group-hover:border-primary/30 transition-colors shadow-sm">
                        @if($client->logo)
                            <img src="{{ Str::startsWith($client->logo, 'http') ? $client->logo : asset('storage/'.$client->logo) }}"
                                alt="{{ $client->name }}" class="w-full h-full object-cover">
                        @else
                            <span class="text-xl font-bold text-primary">{{ strtoupper(substr($client->name,0,1)) }}</span>
                        @endif
                    </div>
                    <p class="text-xs font-semibold text-slate-700 text-center group-hover:text-primary transition-colors leading-tight">
                        {{ $client->name }}
                    </p>
                </div>
                @endforeach
            </div>
            <div class="text-center mt-10">
                <a href="{{ route('about.clients') }}" class="text-primary font-bold text-sm hover:underline">
                    View All Clients →
                </a>
            </div>
        </div>
    </section>
    @endif

@endsection
