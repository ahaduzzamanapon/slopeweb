@extends('frontend.layouts.app')

@section('content')
<section class="py-20 bg-white">
    <div class="container mx-auto px-6">
        <h1 class="text-4xl font-bold text-slate-900 mb-12 text-center">Our Services</h1>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @forelse($services as $service)
                <div class="p-8 border border-slate-100 rounded-2xl shadow-sm hover:shadow-md transition-shadow bg-white flex flex-col justify-between">
                    <div>
                        @if($service->image)
                            <div class="h-48 w-full rounded-xl overflow-hidden mb-6">
                                <img src="{{ Str::startsWith($service->image, 'http') ? $service->image : Storage::url($service->image) }}" class="w-full h-full object-cover">
                            </div>
                        @endif
                        <h3 class="text-xl font-bold mb-4 text-slate-900">{{ $service->title }}</h3>
                        <p class="text-slate-600 font-light leading-relaxed">{{ $service->description }}</p>
                    </div>
                </div>
            @empty
                <div class="col-span-3 text-center py-12 text-slate-500 border border-dashed rounded-2xl">
                    No services found.
                </div>
            @endforelse
        </div>
    </div>
</section>
@endsection
