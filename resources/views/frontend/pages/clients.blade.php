@extends('frontend.layouts.app')

@section('content')
    <!-- Page Banner -->
    <section class="py-24 bg-slate-900 relative overflow-hidden">
        <!-- Abstract Background -->
        <div
            class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/carbon-fibre.png')] opacity-10 mix-blend-overlay">
        </div>
        <div class="absolute inset-0 bg-gradient-to-r from-primary/90 to-slate-900/90 mix-blend-multiply"></div>
        <div class="container mx-auto px-6 relative z-10 text-center fade-up">
            <h1 class="text-4xl md:text-6xl font-display font-extrabold text-white mb-6 tracking-tight">Our <span
                    class="text-accent">Trusted Clients</span></h1>
            <p class="text-slate-300 max-w-2xl mx-auto text-lg md:text-xl font-light leading-relaxed mb-8">We are proud to
                partner with leading healthcare institutions to deliver cutting-edge medical and diagnostic solutions.</p>
            <div class="w-20 h-1.5 bg-accent mx-auto rounded-full shadow-sm"></div>
        </div>
    </section>

    <section class="py-32 bg-slate-50 relative overflow-hidden">
        <!-- Decorative Blurs -->
        <div
            class="absolute top-0 right-0 w-[40rem] h-[40rem] bg-primary/5 rounded-full blur-[120px] -translate-y-1/2 translate-x-1/3">
        </div>
        <div
            class="absolute bottom-0 left-0 w-[40rem] h-[40rem] bg-accent/5 rounded-full blur-[120px] translate-y-1/3 -translate-x-1/3">
        </div>

        <div class="container mx-auto px-6 relative z-10">
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8 max-w-6xl mx-auto">
                <!-- Client Cards -->
                @php
                    $clients = \App\Models\Client::where('active', true)->orderBy('order')->get();
                @endphp
                
                @foreach ($clients as $index => $client)
                    <div class="bg-white p-8 rounded-[2rem] aspect-square flex flex-col items-center justify-center border border-slate-100 soft-shadow hover:shadow-xl hover:-translate-y-2 transition-all duration-500 group fade-up"
                        style="transition-delay: {{ ($index + 1) * 50 }}ms">
                        <div
                            class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mb-6 group-hover:scale-110 group-hover:bg-primary/5 transition-all duration-500 border border-slate-100 group-hover:border-primary/20 overflow-hidden">
                            @if($client->logo)
                                <img src="{{ Str::startsWith($client->logo, 'http') ? $client->logo : Storage::url($client->logo) }}" alt="{{ $client->name }} Logo" class="w-full h-full object-cover">
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="h-8 w-8 text-slate-300 group-hover:text-primary transition-colors" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                            @endif
                        </div>
                        <h4
                            class="font-display font-bold text-slate-900 group-hover:text-primary transition-colors text-center">
                            {{ $client->name }}</h4>
                        <p class="text-xs text-slate-400 mt-2 font-medium uppercase tracking-wider text-center">Valued Client
                        </p>
                        <!-- Decorative accent line on hover -->
                        <div
                            class="w-0 h-1 bg-gradient-to-r from-primary to-accent mt-6 rounded-full group-hover:w-12 transition-all duration-500">
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-24 text-center fade-up delay-500">
                <h3 class="text-2xl md:text-3xl font-display font-bold text-slate-900 mb-6 tracking-tight">Ready to Elevate
                    Your Facility?</h3>
                <p class="text-slate-500 text-lg mb-8 max-w-2xl mx-auto font-light leading-relaxed">Join hundreds of
                    successful healthcare providers who trust Slope Medical for their critical infrastructure needs.</p>
                <a href="{{ route('contact') }}"
                    class="inline-flex items-center gap-2 bg-slate-900 text-white px-8 py-4 rounded-full font-bold uppercase tracking-wider hover:bg-primary transition-colors duration-300 shadow-xl shadow-slate-900/20 hover:shadow-primary/30 group">
                    Contact Us Today
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5 transform group-hover:translate-x-1 transition-transform" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                </a>
            </div>
        </div>
    </section>
@endsection