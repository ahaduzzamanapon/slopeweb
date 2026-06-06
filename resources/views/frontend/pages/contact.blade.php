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
                @if(session('success'))
                    <div class="mb-6 p-4 bg-emerald-50 border-l-4 border-emerald-500 rounded-r-lg text-emerald-800">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-emerald-500" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-semibold">{{ session('success') }}</p>
                            </div>
                        </div>
                    </div>
                @endif

                @if($errors->any())
                    <div class="mb-6 p-4 bg-rose-50 border-l-4 border-rose-500 rounded-r-lg text-rose-800">
                        <ul class="list-disc pl-5 space-y-1">
                            @foreach($errors->all() as $error)
                                <li class="text-sm font-medium">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('contact.post') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <input type="text" name="name" value="{{ old('name') }}" placeholder="Name" class="w-full px-4 py-3 border @error('name') border-rose-500 @else border-slate-300 @enderror rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary" required>
                        @error('name')
                            <p class="text-rose-600 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <input type="email" name="email" value="{{ old('email') }}" placeholder="Email" class="w-full px-4 py-3 border @error('email') border-rose-500 @else border-slate-300 @enderror rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary" required>
                        @error('email')
                            <p class="text-rose-600 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <textarea rows="4" name="message" placeholder="Message" class="w-full px-4 py-3 border @error('message') border-rose-500 @else border-slate-300 @enderror rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary" required>{{ old('message') }}</textarea>
                        @error('message')
                            <p class="text-rose-600 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <button type="submit" class="px-8 py-3 bg-primary text-white font-bold rounded-lg hover:bg-indigo-700 transition-colors">Send Message</button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
