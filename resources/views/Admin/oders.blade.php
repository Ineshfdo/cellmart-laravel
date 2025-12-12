<x-app-layout title="Orders">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Orders Management') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Success / Error Messages --}}
            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg">
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-white shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">

                    <div class="overflow-x-auto w-full">
                        <table class="min-w-full divide-y divide-gray-200 table-fixed">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase w-40">Customer</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase w-56">Products & Qty</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase w-28">Total</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase w-40">Delivery Address</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase w-32">Order Date</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase w-32">Actions</th>
                                </tr>
                            </thead>

                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($orders as $order)
                                    @php
                                        $products = is_string($order->products)
                                            ? json_decode($order->products, true)
                                            : $order->products;
                                    @endphp

                                    <tr class="hover:bg-gray-50">

                                        {{-- Customer --}}
                                        <td class="px-6 py-4 text-sm text-gray-900">
                                            <div>{{ $order->user_email ?? $order->customer_email ?? 'No email' }}</div>
                                            <div class="text-gray-500">{{ $order->user_name ?? $order->customer_name ?? 'Guest' }}</div>
                                            @if($order->customer_phone)
                                                <div class="text-gray-500">{{ $order->customer_phone }}</div>
                                            @endif
                                        </td>

                                        {{-- Products + Quantity (ALIGNED FIX) --}}
                                        <td class="px-6 py-4 text-sm">
                                            <div class="space-y-1">
                                                @foreach($products as $product)
                                                    <div class="flex justify-between gap-4">
                                                        <span class="text-gray-800 break-words">
                                                            {{ $product['name'] ?? 'Unknown Product' }}
                                                        </span>
                                                        <span class="text-gray-600 whitespace-nowrap">
                                                            x {{ $product['quantity'] ?? 0 }}
                                                        </span>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </td>

                                        {{-- Total --}}
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            {{ $order->currency ?? 'LKR' }}
                                            {{ number_format($order->total_amount, 2) }}
                                        </td>

                                        {{-- Address --}}
                                        <td class="px-6 py-4 text-sm text-gray-500 break-words">
                                            {{ Str::limit($order->delivery_address, 40) }}
                                        </td>

                                        {{-- Date --}}
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ \Carbon\Carbon::parse($order->created_at)->format('Y-m-d H:i') }}
                                        </td>

                                        {{-- Actions --}}
                                        <td class="px-6 py-4 text-sm">
                                            <div class="flex flex-col gap-2">

                                                <form action="{{ route('admin.orders.accept', $order->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit"
                                                        onclick="return confirm('Accept this order?');"
                                                        class="w-full px-3 py-2 bg-green-600 text-white rounded-md text-xs hover:bg-green-700">
                                                        Accept
                                                    </button>
                                                </form>

                                                <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        onclick="return confirm('Are you sure you want to delete this order?');"
                                                        class="w-full px-3 py-2 bg-red-600 text-white rounded-md text-xs hover:bg-red-700">
                                                        Delete
                                                    </button>
                                                </form>

                                            </div>
                                        </td>

                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                                            No orders found.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>
