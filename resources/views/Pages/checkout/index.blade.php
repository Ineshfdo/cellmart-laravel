@extends('layouts.theme')
@section('title', 'Checkout')
@section('content')
<div class="bg-gray-100 min-h-screen py-12">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-4xl font-extrabold text-gray-900 mb-8">Checkout</h1>

        @if(request()->has('canceled'))
            <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-6 rounded-lg">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-yellow-700">
                            Payment was canceled. Please try again when you're ready.
                        </p>
                    </div>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-50 border-l-4 border-red-400 p-4 mb-6 rounded-lg">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-red-700">
                            {{ session('error') }}
                        </p>
                    </div>
                </div>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Order Form -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-3xl shadow-lg p-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Delivery Information</h2>
                    
                    <form action="{{ route('checkout.store') }}" method="POST">
                        @csrf
                        
                        <div class="space-y-6">
                            <div>
                                <label for="customer_name" class="block text-sm font-semibold text-gray-700 mb-2">Full Name</label>
                                <input type="text" 
                                       id="customer_name" 
                                       name="customer_name" 
                                       value="{{ old('customer_name', $user ? $user->name : '') }}"
                                       class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                       placeholder="John Doe">
                                @error('customer_name')
                                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="customer_email" class="block text-sm font-semibold text-gray-700 mb-2">Email</label>
                                <input type="email" 
                                       id="customer_email" 
                                       name="customer_email" 
                                       value="{{ old('customer_email', $user ? $user->email : '') }}"
                                       class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                       placeholder="john@example.com">
                                @error('customer_email')
                                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="customer_phone" class="block text-sm font-semibold text-gray-700 mb-2">Phone Number</label>
                                <input type="tel" 
                                       id="customer_phone" 
                                       name="customer_phone" 
                                       value="{{ old('customer_phone') }}"
                                       class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                       placeholder="075-869-0018">
                                @error('customer_phone')
                                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="delivery_address" class="block text-sm font-semibold text-gray-700 mb-2">Delivery Address</label>
                                <textarea id="delivery_address" 
                                          name="delivery_address" 
                                          rows="4" 
                                          required
                                          class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                          placeholder="Enter your complete delivery address">{{ old('delivery_address') }}</textarea>
                                @error('delivery_address')
                                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <button type="submit" 
                                    class="w-full bg-green-600 hover:bg-green-700 text-white px-8 py-4 rounded-xl font-bold text-lg transition shadow-lg">
                                Proceed to Pay
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-3xl shadow-lg p-8 sticky top-24">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Order Summary</h2>
                    
                    <div class="space-y-4 mb-6">
                        @foreach($cartItems as $item)
                            <div class="flex items-start gap-3 pb-4 border-b border-gray-200">
                                <img src="{{ asset($item['product']->image) }}" 
                                     alt="{{ $item['product']->name }}"
                                     class="w-16 h-16 object-contain rounded-lg bg-gray-50">
                                <div class="flex-1">
                                    <h3 class="font-semibold text-gray-900 text-sm">{{ $item['product']->name }}</h3>
                                    <p class="text-xs text-gray-500 mt-1">Qty: {{ $item['quantity'] }}</p>
                                    <div class="flex gap-2 mt-1">
                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium
                                            @if($item['color'] == 'Black') bg-gray-800 text-white
                                            @elseif($item['color'] == 'White') bg-gray-100 text-gray-800 border border-gray-300
                                            @elseif($item['color'] == 'Blue') bg-blue-500 text-white
                                            @elseif($item['color'] == 'Red') bg-red-500 text-white
                                            @elseif($item['color'] == 'Green') bg-green-500 text-white
                                            @endif">
                                            {{ $item['color'] }}
                                        </span>
                                    </div>
                                    <p class="text-xs text-gray-600 mt-1">{{ $item['warranty'] }}</p>
                                </div>
                                <span class="font-bold text-gray-900 text-sm">
                                    {{ $item['product']->currency }} {{ number_format($item['subtotal']) }}
                                </span>
                            </div>
                        @endforeach
                    </div>

                    <div class="border-t border-gray-200 pt-4">
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-gray-600">Subtotal</span>
                            <span class="font-semibold text-gray-900">
                                {{ $cartItems[0]['product']->currency ?? 'LKR' }} {{ number_format($total) }}
                            </span>
                        </div>
                        <div class="flex justify-between items-center mb-4">
                            <span class="text-gray-600">Delivery</span>
                            <span class="font-semibold text-green-600">FREE</span>
                        </div>
                        <div class="flex justify-between items-center pt-4 border-t border-gray-200">
                            <span class="text-lg font-bold text-gray-900">Total</span>
                            <span class="text-2xl font-extrabold text-gray-900">
                                {{ $cartItems[0]['product']->currency ?? 'LKR' }} {{ number_format($total) }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
