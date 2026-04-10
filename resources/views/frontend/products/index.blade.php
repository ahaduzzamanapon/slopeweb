@extends('frontend.layouts.app')

@section('content')

{{-- Page Hero --}}
<section class="bg-gradient-to-r from-primary to-purple-700 text-white py-16">
    <div class="container mx-auto px-6 text-center">
        <h1 class="text-4xl md:text-5xl font-display font-bold mb-4">
            {{ $activeCategory ? $activeCategory->name : 'All Products' }}
        </h1>
        <p class="text-blue-100 text-lg">
            {{ $activeCategory ? 'Browsing products in ' . $activeCategory->name : 'Browse our full range of medical equipment' }}
        </p>
        <div class="mt-4 text-sm text-blue-200">
            <a href="{{ route('home') }}" class="hover:text-white">Home</a>
            <span class="mx-2">/</span>
            <span>Products</span>
            @if($activeCategory)
                <span class="mx-2">/</span>
                <span>{{ $activeCategory->name }}</span>
            @endif
        </div>
    </div>
</section>

<section class="py-12 bg-slate-50">
    <div class="container mx-auto px-6">
        <div class="flex flex-col lg:flex-row gap-8">

            {{-- Sidebar --}}
            <aside class="lg:w-64 flex-shrink-0">
                <div class="bg-white rounded-2xl soft-shadow p-6 sticky top-24">
                    <h3 class="font-display font-bold text-slate-900 text-lg mb-4 pb-3 border-b border-slate-100">Categories</h3>
                    <ul class="space-y-1">
                        <li>
                            <a href="{{ route('products.index') }}"
                               class="block px-3 py-2 rounded-xl text-sm font-medium transition-all {{ !$activeCategory ? 'bg-primary text-white' : 'text-slate-600 hover:bg-primary/5 hover:text-primary' }}">
                                All Products
                            </a>
                        </li>
                        @foreach($allCategories as $cat)
                            <li>
                                <a href="{{ route('products.index', ['category' => $cat->slug ?? $cat->id]) }}"
                                   class="block px-3 py-2 rounded-xl text-sm font-medium transition-all {{ $activeCategory?->id === $cat->id ? 'bg-primary text-white' : 'text-slate-600 hover:bg-primary/5 hover:text-primary' }}">
                                    {{ $cat->name }}
                                    @if($cat->children->count())
                                        <span class="text-xs opacity-60">({{ $cat->children->count() }} sub)</span>
                                    @endif
                                </a>
                                @if($cat->children->count())
                                    <ul class="ml-3 mt-1 space-y-1">
                                        @foreach($cat->children as $child)
                                            <li>
                                                <a href="{{ route('products.index', ['category' => $child->slug ?? $child->id]) }}"
                                                   class="block px-3 py-2 rounded-xl text-xs font-medium transition-all {{ $activeCategory?->id === $child->id ? 'bg-primary/10 text-primary font-semibold' : 'text-slate-500 hover:bg-primary/5 hover:text-primary' }}">
                                                    › {{ $child->name }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </div>
            </aside>

            {{-- Products Grid --}}
            <div class="flex-1">
                @if($products->count())
                    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6">
                        @foreach($products as $product)
                            <a href="{{ route('products.show', $product->slug) }}"
                               class="group bg-white rounded-2xl soft-shadow overflow-hidden hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col fade-up">

                                {{-- Product Image --}}
                                <div class="relative overflow-hidden bg-slate-50 aspect-[4/3]">
                                    @if($product->image)
                                        <img src="{{ Str::startsWith($product->image, 'http') ? $product->image : Storage::url($product->image) }}"
                                             alt="{{ $product->title }}"
                                             class="w-full h-full object-contain p-4 group-hover:scale-105 transition-transform duration-500">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-slate-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
                                            </svg>
                                        </div>
                                    @endif
                                    @if($product->is_featured)
                                        <span class="absolute top-3 right-3 bg-accent text-slate-900 text-xs font-bold px-2 py-1 rounded-full">Featured</span>
                                    @endif
                                    <div class="absolute inset-0 bg-primary/0 group-hover:bg-primary/5 transition-colors duration-300"></div>
                                </div>

                                {{-- Product Info --}}
                                <div class="p-5 flex flex-col flex-grow">
                                    <p class="text-xs text-primary/70 font-medium uppercase tracking-wider mb-1">{{ $product->category->name ?? 'Uncategorized' }}</p>
                                    <h3 class="font-display font-bold text-slate-900 text-base leading-snug mb-3 group-hover:text-primary transition-colors line-clamp-2">
                                        {{ $product->title }}
                                    </h3>
                                    <div class="mt-auto flex items-center justify-between">
                                        <span class="text-primary font-bold text-lg">
                                            @if($product->price > 0) ${{ number_format($product->price, 2) }} @else On Request @endif
                                        </span>
                                        <span class="text-xs px-2 py-1 rounded-full {{ $product->stock_status === 'in_stock' ? 'bg-green-50 text-green-700' : 'bg-amber-50 text-amber-700' }}">
                                            {{ ucfirst(str_replace('_', ' ', $product->stock_status)) }}
                                        </span>
                                    </div>
                                    <div class="mt-4 w-full text-center py-2 bg-primary/5 text-primary rounded-xl text-sm font-semibold group-hover:bg-primary group-hover:text-white transition-all duration-300">
                                        View Details
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>

                    {{-- Pagination --}}
                    <div class="mt-10">
                        {{ $products->appends(request()->query())->links() }}
                    </div>
                @else
                    <div class="text-center py-20 bg-white rounded-2xl soft-shadow">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-slate-200 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                        </svg>
                        <p class="text-slate-400 font-medium">No products found in this category.</p>
                        <a href="{{ route('products.index') }}" class="mt-4 inline-block text-primary hover:text-blue-700 text-sm font-semibold">Browse all products →</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>

@endsection
