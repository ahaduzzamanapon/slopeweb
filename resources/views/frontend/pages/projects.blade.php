@extends('frontend.layouts.app')

@section('content')
<!-- Header Banner -->
<section class="relative bg-slate-900 py-24 text-white overflow-hidden animate-fade-in">
    <div class="absolute inset-0 bg-gradient-to-r from-slate-950 to-slate-900 opacity-95"></div>
    <div class="container mx-auto px-6 relative z-10 text-center">
        <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight mb-4">Our Completed Projects</h1>
        <p class="text-slate-400 max-w-2xl mx-auto text-lg font-light">Discover how we help healthcare centers install, integrate, and configure advanced medical machinery across regions.</p>
    </div>
</section>

<!-- Projects Grid -->
<section class="py-20 bg-slate-50">
    <div class="container mx-auto px-6">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($projects as $project)
                <div class="bg-white border border-slate-100 rounded-3xl overflow-hidden shadow-sm hover:shadow-lg transition-all duration-300 flex flex-col h-full group">
                    @if($project->image)
                        <div class="h-64 w-full overflow-hidden relative bg-slate-100">
                            <img src="{{ Str::startsWith($project->image, 'http') ? $project->image : Storage::url($project->image) }}" 
                                 alt="{{ $project->title }}" 
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        </div>
                    @else
                        <div class="h-64 w-full bg-slate-100 flex items-center justify-center text-slate-300">
                            <span class="text-5xl">🏢</span>
                        </div>
                    @endif
                    
                    <div class="p-8 flex-grow flex flex-col justify-between">
                        <div>
                            <div class="flex items-center gap-2 mb-3">
                                @if($project->client_name)
                                    <span class="text-xs font-semibold bg-primary/10 text-primary px-3 py-1 rounded-full">{{ $project->client_name }}</span>
                                @endif
                                @if($project->completion_date)
                                    <span class="text-xs text-slate-400">
                                        <i class="bi bi-calendar-event me-1"></i>
                                        {{ $project->completion_date->format('M Y') }}
                                    </span>
                                @endif
                            </div>
                            
                            <h3 class="text-xl font-bold mb-4 text-slate-900 group-hover:text-primary transition-colors">{{ $project->title }}</h3>
                            <p class="text-slate-600 font-light leading-relaxed mb-6 text-sm">
                                {{ $project->short_description ?? Str::limit(strip_tags($project->description), 120) }}
                            </p>
                        </div>
                        
                        @if($project->url)
                            <div class="pt-4 border-t border-slate-100">
                                <a href="{{ $project->url }}" target="_blank" class="inline-flex items-center text-sm font-bold text-primary hover:text-opacity-80 transition-colors">
                                    View Project Link <i class="bi bi-arrow-right-short ms-1 text-lg"></i>
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            @empty
                <div class="col-span-3 text-center py-20 bg-white border border-slate-100 rounded-3xl">
                    <div class="text-5xl mb-4 text-slate-300">📂</div>
                    <h4 class="text-xl font-semibold text-slate-700 mb-2">No Projects Found</h4>
                    <p class="text-slate-500">We are updating our projects section. Please check back later!</p>
                </div>
            @endforelse
        </div>
    </div>
</section>
@endsection
