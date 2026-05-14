@extends('frontend.layouts.app')

@section('content')
    <!-- Page Banner -->
    <section class="py-24 bg-slate-900 relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-r from-primary/90 to-slate-900/90"></div>
        <div class="container mx-auto px-6 relative z-10 text-center fade-up">
            <h1 class="text-4xl md:text-6xl font-display font-extrabold text-white mb-6 tracking-tight">
                Our <span class="text-accent">Branches</span>
            </h1>
            <p class="text-slate-300 max-w-2xl mx-auto text-lg md:text-xl font-light leading-relaxed mb-8">
                We are available across multiple locations to serve you better with medical and diagnostic solutions.
            </p>
            <div class="w-20 h-1.5 bg-accent mx-auto rounded-full shadow-sm"></div>
        </div>
    </section>

    <section class="py-24 bg-slate-50 relative overflow-hidden">
        <div class="container mx-auto px-6 relative z-10">
            @php
                $branches = \App\Models\Branch::where('active', true)->orderBy('order')->get();
            @endphp

            @if($branches->isEmpty())
                <div class="text-center text-slate-500 py-16">
                    <div class="text-6xl mb-4">📍</div>
                    <p class="text-xl font-light">No branches found. Please check back soon.</p>
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($branches as $branch)
                        <div class="bg-white rounded-3xl p-8 soft-shadow border border-slate-100 hover:border-primary/20 hover:-translate-y-1 transition-all duration-500 group fade-up text-center">
                            <!-- Logo -->
                            <div class="w-24 h-24 rounded-full bg-slate-50 border border-slate-200 flex items-center justify-center mx-auto mb-6 overflow-hidden group-hover:border-primary/30 transition-colors">
                                @if($branch->logo)
                                    <img src="{{ asset('storage/'.$branch->logo) }}" alt="{{ $branch->name }}" class="w-full h-full object-cover">
                                @else
                                    <span class="text-3xl font-bold text-primary">{{ strtoupper(substr($branch->name,0,1)) }}</span>
                                @endif
                            </div>

                            <h3 class="font-display font-bold text-slate-900 text-xl mb-3 group-hover:text-primary transition-colors">
                                {{ $branch->name }}
                            </h3>

                            @if($branch->address)
                                <p class="text-slate-500 text-sm mb-2 flex items-start justify-center gap-2">
                                    <span class="text-primary mt-0.5">📍</span>{{ $branch->address }}
                                </p>
                            @endif
                            @if($branch->phone)
                                <p class="text-slate-500 text-sm mb-1">
                                    <span class="text-primary">📞</span> {{ $branch->phone }}
                                </p>
                            @endif
                            @if($branch->email)
                                <p class="text-slate-500 text-sm">
                                    <span class="text-primary">✉️</span> {{ $branch->email }}
                                </p>
                            @endif

                            <div class="w-0 h-1 bg-gradient-to-r from-primary to-accent mt-6 rounded-full group-hover:w-16 transition-all duration-500 mx-auto"></div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>
@endsection
