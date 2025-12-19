@extends('layouts.theme')

@section('title', $product->name)

@section('content')
<div class="bg-gray-50 min-h-screen pb-12">
    <!-- Main Product Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="bg-white rounded-3xl shadow-sm overflow-hidden">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-0">
                <!-- Product Image -->
                <div class="p-8 lg:p-12 flex items-center justify-center bg-gray-100">
                    <img src="{{ asset($product->image) }}" 
                         alt="{{ $product->name }}" 
                         class="max-h-[500px] w-auto object-contain mix-blend-multiply hover:scale-105 transition-transform duration-500"
                         onerror="this.src='{{ asset('images/no-image.png') }}'">
                </div>

                <!-- Product Details -->
                <div class="p-8 lg:p-12 flex flex-col justify-center">
                    <div class="mb-2">
                        <span class="inline-block px-3 py-1 text-xs font-semibold tracking-wider text-blue-600 uppercase bg-blue-50 rounded-full">
                            {{ $product->subcategory ?? $product->category }}
                        </span>
                    </div>
                    
                    <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-gray-900 mb-4 tracking-tight">
                        {{ $product->name }}
                    </h1>

                    <!-- Short Description / Key Specs -->
                    <div class="flex flex-wrap gap-4 mb-6 text-sm text-gray-600">
                        @if($product->ram)
                            <div class="flex items-center gap-2 bg-gray-50 px-3 py-2 rounded-lg">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"></path></svg>
                                <span class="font-medium">{{ $product->ram }} RAM</span>
                            </div>
                        @endif
                        @if($product->storage)
                            <div class="flex items-center gap-2 bg-gray-50 px-3 py-2 rounded-lg">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4"></path></svg>
                                <span class="font-medium">{{ $product->storage }} Storage</span>
                            </div>
                        @endif
                    </div>

                    <div class=" mb-8">
                        <div class="inline-flex items-baseline justify-center text-4xl font-bold text-gray-900">
                            <span class="text-2xl text-gray-500 font-normal mr-1">{{ $product->currency }}</span>
                            {{ number_format($product->price) }}
                        </div>
                    </div>
                    
                    @livewire('product-details', ['product' => $product])
                </div>
            </div>
        </div>
    </div>

    <!-- Detailed Description Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-16">
        <div class="bg-white rounded-3xl shadow-sm p-8 lg:p-12">
            <h2 class="text-2xl font-bold text-gray-900 mb-8 flex items-center gap-3">
                <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                Product Overview
            </h2>
            
            <div class="prose prose-lg max-w-none text-gray-600">
                @if($product->description)
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div>
                            <h3 class="text-xl font-semibold text-gray-900 mb-4">Key Features</h3>
                            <ul class="space-y-3">
                                @foreach(array_filter(array_map('trim', explode('.', $product->description))) as $point)
                                    @if(!empty($point) && strlen($point) < 100)
                                        <li class="flex items-start gap-3">
                                            <svg class="w-6 h-6 text-green-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                            <span>{{ $point }}</span>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold text-gray-900 mb-4">Detailed Specifications</h3>
                            <p class="leading-relaxed">
                                Experience the power of the {{ $product->name }}. 
                                @foreach(array_filter(array_map('trim', explode('.', $product->description))) as $point)
                                    @if(!empty($point) && strlen($point) >= 100)
                                        {{ $point }}.
                                    @endif
                                @endforeach
                                Designed for those who demand excellence, this device combines premium aesthetics with high-performance internals.
                            </p>
                        </div>
                    </div>
                @else
                    <p>No detailed description available for this product.</p>
                @endif
            </div>
        </div>
    </div>

    <!-- Related Products -->
    @if(isset($relatedProducts) && $relatedProducts->count() > 0)
    <div class="max-w-7xl mx-auto p-6 pt-12">
        <h2 class="text-2xl font-bold text-gray-900 mb-8">Related Products</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($relatedProducts as $related)
                <a href="{{ route('products.show', $related->id) }}" class="block">
                    <div class="bg-white rounded-2xl shadow-md overflow-hidden hover:shadow-xl hover:-translate-y-1 transition-all duration-300 max-w-xs mx-auto">
                        
                        <!-- Product Image -->
                        <div class="w-full h-64 bg-gray-50">
                            <img 
                                src="{{ asset($related->image) }}" 
                                alt="{{ $related->name }}" 
                                class="w-full h-full object-contain"
                                onerror="this.src='{{ asset('images/no-image.png') }}'"
                            >
                        </div>

                        <!-- Product Info -->
                        <div class="p-4 text-center">
                            <!-- Product Name -->
                            <h3 class="text-lg font-semibold line-clamp-1">
                                {{ $related->name }}
                            </h3>

                            <!-- Price -->
                            <p class="text-gray-700 font-bold text-lg mt-1">
                                {{ $related->currency }} {{ number_format($related->price) }}
                            </p>

                            <!-- RAM & Storage -->
                            @if($related->ram || $related->storage)
                                <p class="text-sm text-gray-600 mt-1">
                                    {{ $related->ram ?? '' }}
                                    @if($related->ram && $related->storage) | @endif
                                    {{ $related->storage ?? '' }}
                                </p>
                            @endif
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
    @endif
</div>
@endsection
