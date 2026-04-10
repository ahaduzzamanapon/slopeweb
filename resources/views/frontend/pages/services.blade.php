@extends('frontend.layouts.app')

@section('content')
<section class="py-20 bg-white">
    <div class="container mx-auto px-6">
        <h1 class="text-4xl font-bold text-slate-900 mb-12 text-center">Our Services</h1>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="p-8 border border-slate-100 rounded-xl shadow-sm">
                <h3 class="text-xl font-bold mb-4">Equipment Installation</h3>
                <p class="text-slate-600">Professional installation of medical machinery by certified technicians.</p>
            </div>
            <div class="p-8 border border-slate-100 rounded-xl shadow-sm">
                <h3 class="text-xl font-bold mb-4">Maintenance & Repair</h3>
                <p class="text-slate-600">24/7 support and regular maintenance contracts for hospitals.</p>
            </div>
            <div class="p-8 border border-slate-100 rounded-xl shadow-sm">
                <h3 class="text-xl font-bold mb-4">User Training</h3>
                <p class="text-slate-600">Comprehensive training for staff on how to operate new equipment.</p>
            </div>
        </div>
    </div>
</section>
@endsection
