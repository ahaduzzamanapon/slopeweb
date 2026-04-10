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
            <h1 class="text-4xl md:text-6xl font-display font-extrabold text-white mb-6 tracking-tight">Message from MD</h1>
            <div class="w-20 h-1.5 bg-accent mx-auto rounded-full shadow-sm"></div>
        </div>
    </section>

    <!-- Content -->
    <section class="py-24 bg-white relative overflow-hidden">
        <!-- Decorative Blurs -->
        <div
            class="absolute top-1/2 left-0 w-96 h-96 bg-primary/5 rounded-full blur-[120px] -translate-y-1/2 -translate-x-1/2">
        </div>
        <div
            class="absolute top-0 right-0 w-[40rem] h-[40rem] bg-slate-50 rounded-full blur-[80px] -translate-y-1/3 translate-x-1/3 -z-10">
        </div>

        <div class="container mx-auto px-6 relative z-10">
            <div class="flex flex-col lg:flex-row gap-16 lg:gap-24 items-center max-w-7xl mx-auto">
                <!-- Author Image -->
                <div class="w-full lg:w-5/12 fade-up delay-100">
                    <div class="relative group mx-auto max-w-md">
                        <div
                            class="absolute inset-0 bg-primary rounded-[3rem] rotate-6 group-hover:rotate-3 transition-transform duration-700 opacity-10">
                        </div>
                        <div
                            class="bg-slate-200 aspect-[4/5] rounded-[3rem] relative z-10 overflow-hidden shadow-2xl border-8 border-white group-hover:-translate-y-2 transition-transform duration-700">
                            <img src="https://ui-avatars.com/api/?name=Saidul+Islam&background=random&size=512&color=fff&font-size=0.33"
                                alt="Managing Director"
                                class="w-full h-full object-cover filter contrast-[0.95] group-hover:scale-105 transition-transform duration-1000">
                        </div>
                    </div>
                </div>

                <!-- Message Content -->
                <div class="w-full lg:w-7/12 fade-up delay-200">
                    <div class="glass p-12 md:p-16 rounded-[3.5rem] shadow-xl border border-white/60 relative">
                        <div class="absolute top-12 right-12 text-9xl text-primary/5 font-serif leading-none select-none">"
                        </div>
                        <h2
                            class="text-3xl md:text-4xl font-display font-bold text-slate-900 mb-10 pb-6 border-b border-slate-100 tracking-tight">
                            A Commitment to Excellence</h2>

                        <div class="prose prose-lg text-slate-600 font-light leading-relaxed max-w-none relative z-10">
                            @if($globalSettings->md_message)
                                {!! nl2br(e($globalSettings->md_message)) !!}
                            @else
                                <p class="text-2xl md:text-3xl text-slate-700 italic leading-snug mb-10 font-display">
                                    "Message content will appear here once updated from the admin panel."
                                </p>
                            @endif

                            <div class="mt-12 flex items-center gap-6 pt-8 border-t border-slate-100">
                                <div class="w-16 h-1.5 bg-gradient-to-r from-primary to-accent rounded-full"></div>
                                <div>
                                    <p class="font-bold text-slate-900 text-xl font-display tracking-tight">{{ $globalSettings->md_name ?? 'Managing Director' }}</p>
                                    <p class="text-primary text-sm font-semibold uppercase tracking-widest mt-1">Managing
                                        Director</p>
                                    @if($globalSettings->signature)
                                        <div class="mt-4">
                                            <img src="{{ Storage::url($globalSettings->signature) }}" alt="Signature" class="h-10">
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection