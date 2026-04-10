@extends('frontend.layouts.app')

@section('content')
    <!-- Glassmorphism Banner -->
    <section class="relative py-24 bg-slate-900 overflow-hidden">
        <div class="absolute inset-0 z-0">
            <video autoplay muted loop playsinline class="w-full h-full object-cover opacity-20">
                <source src="{{ asset('frontend/videos/hero-video.mp4') }}" type="video/mp4">
            </video>
            <div class="absolute inset-0 bg-gradient-to-tr from-primary/90 to-slate-900/90 mix-blend-multiply"></div>
        </div>
        <div class="container mx-auto px-6 relative z-10 text-center fade-up">
            <h1 class="text-5xl md:text-6xl font-display font-extrabold text-white mb-6 tracking-tight">About <span
                    class="text-accent">Slope Medical</span></h1>
            <div class="w-24 h-1.5 bg-accent mx-auto rounded-full shadow-sm"></div>
        </div>
    </section>

    <!-- Content Area -->
    <section class="py-24 bg-slate-50 relative overflow-hidden">
        <!-- Decorative Floating Elements -->
        <div
            class="absolute top-0 right-0 w-96 h-96 bg-primary/5 rounded-full blur-[100px] -translate-y-1/2 translate-x-1/3">
        </div>
        <div
            class="absolute bottom-0 left-0 w-96 h-96 bg-accent/5 rounded-full blur-[100px] translate-y-1/3 -translate-x-1/3">
        </div>

        <div class="container mx-auto px-6 relative z-10">
            <div
                class="max-w-4xl mx-auto glass p-12 md:p-16 rounded-[3.5rem] shadow-2xl border border-white/60 fade-up delay-100 relative">
                <h2 class="text-3xl md:text-4xl font-display font-bold text-slate-900 mb-8 tracking-tight">Pioneering
                    Healthcare Excellence</h2>
                <div class="prose prose-lg text-slate-600 font-light leading-relaxed max-w-none">
                    <p class="text-xl md:text-2xl text-slate-700 leading-relaxed mb-12">Welcome to <strong
                            class="font-bold text-primary font-display tracking-tight">Slope Medical</strong>. We are a
                        premier provider of medical equipment and accessories, dedicated to serving healthcare professionals
                        with the highest quality products.</p>
                    <div class="grid md:grid-cols-2 gap-8 my-16">
                        <div
                            class="bg-white p-10 rounded-3xl soft-shadow border border-slate-50 hover:border-primary/20 transition-all group">
                            <div
                                class="w-20 h-20 bg-primary/5 text-primary rounded-3xl flex items-center justify-center mb-8 text-4xl group-hover:scale-110 transition-transform">
                                🎯</div>
                            <h3 class="text-2xl font-bold text-slate-900 mb-4 font-display">Our Mission</h3>
                            <p class="text-slate-500 text-lg leading-relaxed">To improve patient care through advanced
                                technology, supplying state-of-the-art instruments and machinery that you can rely on.</p>
                        </div>
                        <div
                            class="bg-white p-10 rounded-3xl soft-shadow border border-slate-50 hover:border-primary/20 transition-all group">
                            <div
                                class="w-20 h-20 bg-primary/5 text-primary rounded-3xl flex items-center justify-center mb-8 text-4xl group-hover:scale-110 transition-transform">
                                👁️</div>
                            <h3 class="text-2xl font-bold text-slate-900 mb-4 font-display">Our Vision</h3>
                            <p class="text-slate-500 text-lg leading-relaxed">To be the most trusted partner in building
                                modern, resilient, and efficient healthcare infrastructure globally.</p>
                        </div>
                    </div>
                    <p class="text-lg text-slate-600">Founded with a mission to improve patient care through advanced
                        technology, we supply hospitals, clinics, and laboratories with state-of-the-art instruments and
                        machinery. Our commitment goes beyond selling equipment; we aim to foster long-term partnerships
                        through exceptional service and support.</p>
                </div>
            </div>
        </div>
    </section>
@endsection