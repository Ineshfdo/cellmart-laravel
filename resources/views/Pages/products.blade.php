@extends('layouts.theme')

@section('title', 'All Products')

@section('content')
<div class="bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        <!-- Header & Search Section -->
        <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">
            <h1 class="text-3xl font-bold text-gray-900">Products</h1>
            
            <!-- Search Bar -->
            <div class="w-full md:w-96">
                <form method="GET" action="{{ route('products.index') }}">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        <input 
                            type="text" 
                            name="search" 
                            value="{{ request('search') }}"
                            class="block w-full pl-10 pr-3 py-2.5 border border-gray-200 rounded-lg leading-5 bg-white placeholder-gray-400 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 sm:text-sm shadow-sm" 
                            placeholder="Search products..."
                        >
                    </div>
                </form>
            </div>
        </div>

        <div class="flex flex-col lg:flex-row gap-8">
            
            <!-- Sidebar Filters -->
            <aside class="lg:w-72 flex-shrink-0">
                <div class="bg-white rounded-xl shadow-sm p-6 sticky top-4 border border-gray-100">
                    <!-- Header with Clear All -->
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-lg font-bold text-gray-900">Categories</h2>
                        @if(request()->hasAny(['search', 'category', 'subcategory']))
                            <a href="{{ route('products.index') }}" class="text-xs font-medium text-blue-600 hover:text-blue-800 transition-colors">
                                Clear All
                            </a>
                        @endif
                    </div>
                    
                    <!-- Categories Accordion -->
                    <div class="space-y-2">
                        @foreach($categories as $category => $subcategories)
                            {{-- Check if this category is active (has the selected subcategory) --}}
                            @php
                                $isActiveCategory = $subcategories->contains('subcategory', request('subcategory'));
                            @endphp

                            <div x-data="{ open: {{ $isActiveCategory ? 'true' : 'false' }} }" class="border-b border-gray-50 last:border-0 pb-2">
                                <button 
                                    @click="open = !open" 
                                    class="flex items-center justify-between w-full py-2 text-left group focus:outline-none"
                                >
                                    <span 
                                        class="font-semibold transition-colors"
                                        :class="open ? 'text-blue-600' : 'text-gray-700 group-hover:text-blue-600'"
                                    >
                                        {{ $category }}
                                    </span>
                                    <svg 
                                        class="w-4 h-4 text-gray-400 transition-transform duration-200" 
                                        :class="{'rotate-180 text-blue-600': open}"
                                        fill="none" 
                                        stroke="currentColor" 
                                        viewBox="0 0 24 24"
                                    >
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </button>
                                
                                <div 
                                    x-show="open" 
                                    x-collapse 
                                    class="pl-4 space-y-3 mt-2"
                                    style="display: none;"
                                >
                                    <!-- All [Category] Option -->
                                    <a 
                                        href="{{ route('products.index', ['category' => $category]) }}" 
                                        class="block text-sm transition-colors {{ request('category') == $category && !request('subcategory') ? 'text-blue-600 font-medium' : 'text-gray-500 hover:text-blue-600' }}"
                                    >
                                        All {{ $category }}
                                    </a>

                                    @foreach($subcategories as $subcategory)
                                        <a 
                                            href="{{ route('products.index', ['subcategory' => $subcategory->subcategory]) }}" 
                                            class="block text-sm transition-colors {{ request('subcategory') == $subcategory->subcategory ? 'text-blue-600 font-medium' : 'text-gray-500 hover:text-blue-600' }}"
                                        >
                                            {{ $subcategory->subcategory }}
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </aside>

            <!-- Products Grid -->
            <main class="flex-1">
                @if($products->count() > 0)
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                        @foreach($products as $product)
                            <a href="{{ route('products.show', $product->id) }}" class="block h-full">
                                <div class="bg-white rounded-2xl shadow-md overflow-hidden hover:shadow-xl hover:-translate-y-1 transition-all duration-300 h-full flex flex-col max-w-xs mx-auto w-full">
                                    
                                    <!-- Product Image -->
                                    <div class="w-full h-64 bg-gray-50 p-4">
                                        <img 
                                            src="{{ asset($product->image) }}" 
                                            alt="{{ $product->name }}" 
                                            class="w-full h-full object-contain mix-blend-multiply"
                                            onerror="this.src='{{ asset('images/no-image.png') }}'"
                                        >
                                    </div>

                                    <!-- Product Info -->
                                    <div class="p-5 flex-grow flex flex-col text-center">
                                        <div class="mb-2">
                                            <span class="text-xs font-semibold tracking-wider text-blue-600 uppercase bg-blue-50 px-2 py-1 rounded-full">
                                                {{ $product->subcategory ?? $product->category }}
                                            </span>
                                        </div>

                                        <h3 class="text-lg font-bold text-gray-900 line-clamp-2 mb-2 flex-grow">
                                            {{ $product->name }}
                                        </h3>

                                        <div class="mt-auto">
                                            <p class="text-xl font-bold text-gray-900 mb-2">
                                                <span class="text-sm font-normal text-gray-500 relative top-0.1 mr-0.5">
                                                    {{ $product->currency }}
                                                </span>
                                                {{ number_format($product->price) }}
                                            </p>

                                            @if($product->ram || $product->storage)
                                                <div class="flex items-center justify-center gap-2 text-xs text-gray-500 border-t border-gray-100 pt-3">
                                                    @if($product->ram)
                                                        <span class="flex items-center gap-1">
                                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"></path></svg>
                                                            {{ $product->ram }}
                                                        </span>
                                                    @endif
                                                    @if($product->ram && $product->storage)
                                                        <span class="text-gray-300">|</span>
                                                    @endif
                                                    @if($product->storage)
                                                        <span class="flex items-center gap-1">
                                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4"></path></svg>
                                                            {{ $product->storage }}
                                                        </span>
                                                    @endif
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="mt-8">
                        {{ $products->links() }}
                    </div>
                @else
                    <div class="bg-white rounded-xl shadow-sm p-12 text-center border border-gray-100">
                        <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">No products found</h3>
                        <p class="text-gray-500 mb-6">We couldn't find any products matching your search.</p>
                        <a href="{{ route('products.index') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition-colors">
                            View All Products
                        </a>
                    </div>
                @endif
            </main>
        </div>
    </div>
</div>
@endsection
