@extends('frontend.layouts.app')

@section('content')
    <!-- Page Banner -->
    <section class="py-24 bg-slate-900 relative overflow-hidden">
        <!-- Abstract Background -->
        <div
            class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/carbon-fibre.png')] opacity-10 mix-blend-overlay">
        </div>
        <div class="absolute inset-0 bg-gradient-to-tr from-primary/90 to-slate-900/90 mix-blend-multiply"></div>
        <div class="container mx-auto px-6 relative z-10 text-center fade-up">
            <h1 class="text-4xl md:text-6xl font-display font-extrabold text-white mb-4 tracking-tight">Meet The <span
                    class="text-accent">Dynamic Team</span></h1>
            <h2 class="text-lg md:text-xl font-medium text-slate-300 uppercase tracking-[0.25em] mb-8">Of Slope Medical
                Solution</h2>
            <div class="w-20 h-1.5 bg-accent mx-auto rounded-full shadow-sm"></div>
        </div>
    </section>

    <section class="py-24 bg-slate-50 relative overflow-hidden">
        <!-- Decorative Blurs -->
        <div
            class="absolute top-0 right-0 w-96 h-96 bg-primary/5 rounded-full blur-[100px] -translate-y-1/2 translate-x-1/3">
        </div>
        <div
            class="absolute bottom-0 left-0 w-96 h-96 bg-accent/5 rounded-full blur-[100px] translate-y-1/3 -translate-x-1/3">
        </div>

        <div class="container mx-auto px-6 relative z-10">
            <!-- Managing Director (Top) -->
            @php
                $md = \App\Models\TeamMember::where('active', true)->where('designation', 'Managing Director')->first();
                $management = \App\Models\TeamMember::where('active', true)->where('type', 'management')->where('id', '!=', $md?->id ?? 0)->orderBy('order')->get();
                $engineers = \App\Models\TeamMember::where('active', true)->where('type', 'engineer')->orderBy('order')->get();
            @endphp
            
            @if($md)
            <div class="flex justify-center mb-20 fade-up">
                <div class="text-center group relative">
                    <div
                        class="absolute inset-0 bg-primary/5 rounded-[3rem] blur-2xl group-hover:bg-primary/10 transition-colors duration-500">
                    </div>
                    <div class="w-56 h-56 mx-auto mb-8 relative z-10">
                        <div
                            class="absolute inset-0 bg-primary rounded-full rotate-6 group-hover:rotate-12 transition-transform duration-500 opacity-20">
                        </div>
                        <img src="{{ Str::startsWith($md->image, 'http') ? $md->image : Storage::url($md->image) }}"
                            alt="{{ $md->name }}"
                            class="w-full h-full object-cover rounded-full border-8 border-white relative z-10 shadow-2xl group-hover:-translate-y-2 transition-transform duration-500">
                    </div>
                    <h3 class="text-3xl font-bold text-slate-900 font-display tracking-tight mb-3">{{ $md->name }}</h3>
                    <div
                        class="inline-flex items-center gap-2 bg-slate-900 text-white px-6 py-2 rounded-full text-sm font-bold uppercase tracking-widest shadow-lg shadow-slate-900/20">
                        <span class="w-2 h-2 rounded-full bg-accent animate-pulse"></span>
                        {{ $md->designation }}
                    </div>
                </div>
            </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-16 max-w-7xl mx-auto">
                <!-- Left Side: Management (Vertical Stack) -->
                <div class="lg:col-span-4 space-y-10 flex flex-col items-center lg:items-end fade-up delay-100">
                    @foreach($management as $index => $member)
                        @php
                            $colors = [['border' => 'border-primary/10', 'bg' => 'bg-primary/5', 'text' => 'text-primary'], ['border' => 'border-accent/20', 'bg' => 'bg-accent/10', 'text' => 'text-yellow-700']];
                            $color = $colors[$index % 2];
                        @endphp
                        <div
                            class="flex items-center gap-6 text-right flex-row-reverse lg:flex-row bg-white p-6 rounded-[2rem] w-full lg:w-auto soft-shadow border border-slate-50 hover:border-primary/20 transition-all group">
                            <div>
                                <h4 class="text-xl font-bold text-slate-900 font-display">{{ $member->name }}</h4>
                                <span
                                    class="inline-block {{ $color['text'] }} font-bold {{ $color['bg'] }} px-4 py-1.5 rounded-full text-xs uppercase tracking-widest mt-2 border {{ $color['border'] }}">{{ $member->designation }}</span>
                            </div>
                            <div
                                class="w-24 h-24 rounded-full overflow-hidden border-4 border-slate-50 shadow-md group-hover:scale-105 transition-transform flex-shrink-0">
                                <img src="{{ Str::startsWith($member->image, 'http') ? $member->image : Storage::url($member->image) }}"
                                    class="w-full h-full object-cover">
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Right Side: Engineers (Grid) -->
                <div class="lg:col-span-8 fade-up delay-200">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
                        @foreach($engineers as $member)
                        <div
                            class="bg-white p-8 rounded-[2rem] border border-slate-50 soft-shadow hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group flex items-center gap-6">
                            <div class="relative w-24 h-24 flex-shrink-0">
                                <div
                                    class="absolute inset-0 bg-primary/10 rounded-full scale-110 group-hover:scale-125 transition-transform duration-500">
                                </div>
                                <img src="{{ Str::startsWith($member->image, 'http') ? $member->image : Storage::url($member->image) }}"
                                    class="w-full h-full rounded-full border-4 border-white shadow-sm relative z-10 group-hover:scale-105 transition-transform">
                            </div>
                            <div>
                                <h4 class="text-xl font-bold text-slate-900 font-display mb-1">{{ $member->name }}</h4>
                                <p class="text-slate-500 text-sm font-medium uppercase tracking-wide">{{ $member->designation }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection