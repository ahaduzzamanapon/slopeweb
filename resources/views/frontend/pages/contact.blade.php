@extends('frontend.layouts.app')

@section('content')
<section class="py-20 bg-white">
    <div class="container mx-auto px-6">
        <h1 class="text-4xl font-bold text-slate-900 mb-12 text-center">Contact Us</h1>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
            <div>
                <h3 class="text-2xl font-bold mb-6">Get in Touch</h3>
                <div class="space-y-4 text-slate-600">
                    <p><strong class="block text-slate-900">Address:</strong> {{ $globalSettings->address ?? 'Dhaka, Bangladesh' }}</p>
                    <p><strong class="block text-slate-900">Email:</strong> {{ $globalSettings->email ?? 'info@slope.test' }}</p>
                    <p><strong class="block text-slate-900">Phone:</strong> {{ $globalSettings->phone ?? '+880 1234 567890' }}</p>
                </div>
            </div>
            <div>
                 <form class="space-y-4">
                    <input type="text" placeholder="Name" class="w-full px-4 py-3 border border-slate-300 rounded-lg">
                    <input type="email" placeholder="Email" class="w-full px-4 py-3 border border-slate-300 rounded-lg">
                    <textarea rows="4" placeholder="Message" class="w-full px-4 py-3 border border-slate-300 rounded-lg"></textarea>
                    <button class="px-8 py-3 bg-primary text-white font-bold rounded-lg hover:bg-indigo-700">Send Message</button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
