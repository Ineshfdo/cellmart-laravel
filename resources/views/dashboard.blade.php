<x-app-layout title="Dashboard">
    <div class="min-h-screen bg-gray-100 dark:bg-zinc-900 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Page Header -->
            <div class="mb-8">
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Dashboard</h1>
            </div>

            <!-- Stats Overview -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Total Products -->
                <div class="bg-white dark:bg-zinc-800 overflow-hidden shadow-sm rounded-xl border border-gray-100 dark:border-zinc-700">
                    <div class="p-6">
                        <div class="flex flex-col h-full justify-between">
                            <span class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Products</span>
                            <span class="text-4xl font-bold text-gray-900 dark:text-white mt-4">{{ $totalProducts }}</span>
                        </div>
                    </div>
                </div>

                <!-- Registered Customers -->
                <div class="bg-white dark:bg-zinc-800 overflow-hidden shadow-sm rounded-xl border border-gray-100 dark:border-zinc-700">
                    <div class="p-6">
                        <div class="flex flex-col h-full justify-between">
                            <span class="text-sm font-medium text-gray-500 dark:text-gray-400">Registered Customers</span>
                            <span class="text-4xl font-bold text-gray-900 dark:text-white mt-4">{{ $totalCustomers }}</span>
                        </div>
                    </div>
                </div>

                <!-- Total Orders -->
                <div class="bg-white dark:bg-zinc-800 overflow-hidden shadow-sm rounded-xl border border-gray-100 dark:border-zinc-700">
                    <div class="p-6">
                        <div class="flex flex-col h-full justify-between">
                            <span class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Orders</span>
                            <span class="text-4xl font-bold text-gray-900 dark:text-white mt-4">{{ $totalOrders }}</span>
                        </div>
                    </div>
                </div>

                <!-- Accepted Orders -->
                <div class="bg-white dark:bg-zinc-800 overflow-hidden shadow-sm rounded-xl border border-gray-100 dark:border-zinc-700">
                    <div class="p-6">
                        <div class="flex flex-col h-full justify-between">
                            <span class="text-sm font-medium text-gray-500 dark:text-gray-400">Accepted Orders</span>
                            <div class="mt-4">
                                <span class="text-4xl font-bold text-gray-900 dark:text-white block">{{ $acceptedOrdersCount }}</span>
                                <span class="text-xs text-gray-500 dark:text-gray-400 mt-1 block">Total: {{ number_format($acceptedOrdersTotal, 2) }} LKR</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Latest Products -->
            <div class="bg-white dark:bg-zinc-800 overflow-hidden shadow-sm rounded-xl border border-gray-100 dark:border-zinc-700 mb-8">
                <div class="p-6 border-b border-gray-100 dark:border-zinc-700 flex items-center justify-between">
                    <h2 class="text-lg font-bold text-gray-900 dark:text-white">Latest Products</h2>
                    <a href="{{ route('admin.products.create') }}" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors shadow-sm">
                        Add New Product
                    </a>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-zinc-700">
                        <thead class="bg-gray-50 dark:bg-zinc-900/50">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Product Name</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Category</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Price</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-zinc-800 divide-y divide-gray-200 dark:divide-zinc-700">
                            @forelse($latestProducts as $product)
                            <tr class="hover:bg-gray-50 dark:hover:bg-zinc-700/50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">{{ $product->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">{{ $product->category }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white font-medium">{{ number_format($product->price, 2) }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="px-6 py-8 text-center text-gray-500 dark:text-gray-400">No products found.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Latest Orders -->
            <div class="bg-white dark:bg-zinc-800 overflow-hidden shadow-sm rounded-xl border border-gray-100 dark:border-zinc-700 mb-8">
                <div class="p-6 border-b border-gray-100 dark:border-zinc-700 flex items-center justify-between">
                    <h2 class="text-lg font-bold text-gray-900 dark:text-white">Latest Orders</h2>
                    <a href="{{ route('admin.orders.index') }}" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors shadow-sm">
                        View All
                    </a>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-zinc-700">
                        <thead class="bg-gray-50 dark:bg-zinc-900/50">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Customer</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Products</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Quantity</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Total</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-zinc-800 divide-y divide-gray-200 dark:divide-zinc-700">
                            @forelse($latestOrders as $order)
                                @php
                                    $products = is_string($order->products) ? json_decode($order->products, true) : $order->products;
                                    $itemCount = collect($products)->sum('quantity');
                                @endphp
                            <tr class="hover:bg-gray-50 dark:hover:bg-zinc-700/50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900 dark:text-white">
                                        {{ $order->user_name ?? $order->customer_name ?? 'Guest' }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                    <div class="space-y-1">
                                        @foreach($products as $product)
                                            <div class="text-sm text-gray-900 dark:text-gray-300">{{ $product['name'] ?? 'Unknown Product' }}</div>
                                        @endforeach
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                    {{ $itemCount }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">
                                    {{ number_format($order->total_amount, 2) }}
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="px-6 py-8 text-center text-gray-500 dark:text-gray-400">No orders found.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Latest Customers -->
            <div class="bg-white dark:bg-zinc-800 overflow-hidden shadow-sm rounded-xl border border-gray-100 dark:border-zinc-700 mb-8">
                <div class="p-6 border-b border-gray-100 dark:border-zinc-700 flex items-center justify-between">
                    <h2 class="text-lg font-bold text-gray-900 dark:text-white">Latest Customers</h2>
                    <a href="{{ route('admin.customers.index') }}" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors shadow-sm">
                        View All
                    </a>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-zinc-700">
                        <thead class="bg-gray-50 dark:bg-zinc-900/50">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Customer Name</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Email</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Registered Date</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-zinc-800 divide-y divide-gray-200 dark:divide-zinc-700">
                            @forelse($latestCustomers as $customer)
                            <tr class="hover:bg-gray-50 dark:hover:bg-zinc-700/50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">{{ $customer->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">{{ $customer->email }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                    {{ $customer->created_at->format('Y-m-d H:i:s') }}
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="px-6 py-8 text-center text-gray-500 dark:text-gray-400">No customers found.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Latest Feedback -->
            <div class="bg-white dark:bg-zinc-800 overflow-hidden shadow-sm rounded-xl border border-gray-100 dark:border-zinc-700">
                <div class="p-6 border-b border-gray-100 dark:border-zinc-700">
                    <h2 class="text-lg font-bold text-gray-900 dark:text-white">Latest Feedback</h2>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-zinc-700">
                        <thead class="bg-gray-50 dark:bg-zinc-900/50">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Name</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Email</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Subject</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Message</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-zinc-800 divide-y divide-gray-200 dark:divide-zinc-700">
                            @forelse($latestFeedback as $feedback)
                            <tr class="hover:bg-gray-50 dark:hover:bg-zinc-700/50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">{{ $feedback->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">{{ $feedback->email }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">{{ $feedback->subject }}</td>
                                <td class="px-6 py-4 text-sm text-gray-500 dark:text-gray-400 max-w-xs truncate">
                                    {{ $feedback->message }}
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="px-6 py-8 text-center text-gray-500 dark:text-gray-400">No feedback found.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
