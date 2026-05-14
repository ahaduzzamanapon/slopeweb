@extends('frontend.layouts.app')

@section('content')
    <!-- Breadcrumbs -->
    <div class="bg-gray-50 py-4 border-b border-gray-100">
        <div class="container mx-auto px-6 text-sm text-gray-500">
            <a href="{{ route('home') }}" class="hover:text-primary">Home</a>
            <span class="mx-2">/</span>
            <span class="text-gray-700">{{ $product->category->name ?? 'Products' }}</span>
            <span class="mx-2">/</span>
            <span class="font-medium text-gray-900">{{ $product->title }}</span>
        </div>
    </div>

    <!-- Product Details -->
    <section class="py-12 bg-white">
        <div class="container mx-auto px-6">
            <h1 class="text-3xl md:text-4xl font-bold text-slate-900 mb-8 border-b pb-4">{{ $product->title }}</h1>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 mb-12">
                <!-- Left Column: Image -->
                <div class="bg-white border rounded-xl overflow-hidden shadow-sm flex items-center justify-center p-4">
                    @if($product->image)
                        <img src="{{ Str::startsWith($product->image, 'http') ? $product->image : Storage::url($product->image) }}"
                            alt="{{ $product->title }}" class="max-h-[500px] w-full object-contain">
                    @else
                        <div class="h-96 flex items-center justify-center text-slate-300">
                            <span class="text-6xl">📷</span>
                        </div>
                    @endif
                </div>

                <!-- Right Column: Specs & Actions -->
                <div>
                    <div class="bg-slate-50 border border-slate-100 rounded-xl p-8 mb-8">
                        <h3 class="text-xl font-bold text-slate-900 mb-6 border-b pb-2">Product Specification</h3>
                        <table class="w-full text-slate-700">
                            <tbody>
                                @if($product->brand)
                                    <tr class="border-b border-dashed border-slate-200">
                                        <td class="py-3 font-semibold w-1/3">Brand</td>
                                        <td class="py-3 font-bold text-slate-900">: {{ $product->brand }}</td>
                                    </tr>
                                @endif
                                @if($product->model)
                                    <tr class="border-b border-dashed border-slate-200">
                                        <td class="py-3 font-semibold">Model</td>
                                        <td class="py-3">: {{ $product->model }}</td>
                                    </tr>
                                @endif
                                @if($product->origin)
                                    <tr class="border-b border-dashed border-slate-200">
                                        <td class="py-3 font-semibold">Origin</td>
                                        <td class="py-3">: {{ $product->origin }}</td>
                                    </tr>
                                @endif
                                @if($product->assembly)
                                    <tr class="border-b border-dashed border-slate-200">
                                        <td class="py-3 font-semibold">Assembly</td>
                                        <td class="py-3">: {{ $product->assembly }}</td>
                                    </tr>
                                @endif
                                @if($product->warranty)
                                    <tr>
                                        <td class="py-3 font-semibold">Warranty</td>
                                        <td class="py-3">: {{ $product->warranty }}</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>

                    <div class="flex flex-col gap-4">
                        @if($product->catalog)
                            <button onclick="document.getElementById('catalogueModal').classList.remove('hidden')"
                                class="w-full bg-slate-800 hover:bg-slate-900 text-white font-bold py-4 px-6 rounded-lg flex items-center justify-center gap-2 transition-all">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                </svg>
                                Download Product Catalog
                            </button>
                        @endif

                        <a href="{{ route('home') }}#contact"
                            class="w-full border-2 border-primary text-primary hover:bg-primary hover:text-white font-bold py-4 px-6 rounded-lg flex items-center justify-center gap-2 transition-all">
                            Contact For Inquiry
                        </a>
                    </div>
                </div>
            </div>

            <!-- Description & Features -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                <div class="lg:col-span-2">
                    <h3 class="text-2xl font-bold text-slate-900 mb-6 flex items-center gap-2">
                        <span class="w-2 h-8 bg-primary rounded-full"></span>
                        Product Description
                    </h3>
                    <div class="prose prose-lg text-slate-600 max-w-none bg-white p-6 border rounded-xl shadow-sm">
                        {!! nl2br(e($product->description)) !!}
                    </div>
                </div>

                <div class="lg:col-span-1">
                    @if($product->features)
                        <h3 class="text-2xl font-bold text-slate-900 mb-6 flex items-center gap-2">
                            <span class="w-2 h-8 bg-teal-500 rounded-full"></span>
                            Features
                        </h3>
                        <div class="bg-slate-50 p-6 rounded-xl border border-slate-200 prose prose-indigo">
                            {!! $product->features !!}
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </section>

    <!-- Catalogue Download Modal -->
    <div id="catalogueModal" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4" style="background:rgba(0,0,0,0.6)">
        <div class="bg-white rounded-3xl shadow-2xl w-full max-w-md p-8 relative fade-up">
            <button onclick="document.getElementById('catalogueModal').classList.add('hidden')"
                class="absolute top-4 right-4 text-slate-400 hover:text-slate-900 transition-colors text-2xl leading-none">&times;</button>
            <div class="text-center mb-6">
                <div class="text-4xl mb-3">📥</div>
                <h3 class="text-2xl font-display font-bold text-slate-900">Get the Catalogue</h3>
                <p class="text-slate-500 text-sm mt-1">Please enter your details to download.</p>
            </div>
            <form action="{{ route('catalogue.download') }}" method="POST">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <div class="mb-4">
                    <label class="block text-sm font-semibold text-slate-700 mb-1">Your Name <span class="text-red-500">*</span></label>
                    <input type="text" name="name" required placeholder="e.g. Dr. Rahman"
                        class="w-full border border-slate-200 rounded-xl px-4 py-3 text-slate-800 focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition">
                </div>
                <div class="mb-6">
                    <label class="block text-sm font-semibold text-slate-700 mb-1">Mobile Number <span class="text-red-500">*</span></label>
                    <input type="tel" name="phone" required placeholder="+880..."
                        class="w-full border border-slate-200 rounded-xl px-4 py-3 text-slate-800 focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition">
                </div>
                <button type="submit"
                    class="w-full py-4 bg-primary text-white font-bold rounded-xl hover:bg-opacity-90 transition-all shadow-lg shadow-primary/30">
                    📥 Download Now
                </button>
            </form>
        </div>
    </div>
@endsection