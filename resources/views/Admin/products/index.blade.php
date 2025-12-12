<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Products Management') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Success/Error Messages -->
            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg">
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @if(session('error'))
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg">
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            <!-- Products Table -->
            <div class="bg-white shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">

                    <!-- Responsive table wrapper FIXED -->
                    <div class="overflow-x-auto w-full">

                        <table class="min-w-full divide-y divide-gray-200 table-auto">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Image</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Category</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Subcategory</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Price</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Description</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                                </tr>
                            </thead>

                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($products as $product)
                                    <tr class="hover:bg-gray-50">

                                        <!-- Image -->
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if($product->image)
                                                @php
                                                    $imageSrc = filter_var($product->image, FILTER_VALIDATE_URL)
                                                        ? $product->image
                                                        : asset($product->image);
                                                @endphp
                                                <img src="{{ $imageSrc }}"
                                                     alt="{{ $product->name }}"
                                                     class="w-16 h-16 object-cover rounded-lg"
                                                     onerror="this.onerror=null; this.src='data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%22100%22 height=%22100%22%3E%3Crect fill=%22%23ddd%22 width=%22100%22 height=%22100%22/%3E%3Ctext fill=%22%23999%22 x=%2250%25%22 y=%2250%25%22 text-anchor=%22middle%22 dy=%22.3em%22%3ENo Image%3C/text%3E%3C/svg%3E';">
                                            @else
                                                <div class="w-16 h-16 bg-gray-200 rounded-lg flex items-center justify-center">
                                                    <span class="text-xs text-gray-400">No Image</span>
                                                </div>
                                            @endif
                                        </td>

                                        <!-- Name -->
                                        <td class="px-6 py-4 text-sm font-medium text-gray-900">
                                            {{ $product->name }}
                                        </td>

                                        <!-- Category -->
                                        <td class="px-6 py-4 text-sm text-gray-500">
                                            {{ $product->category }}
                                        </td>

                                        <!-- Subcategory -->
                                        <td class="px-6 py-4 text-sm text-gray-500">
                                            {{ $product->subcategory ?? 'N/A' }}
                                        </td>

                                        <!-- Price -->
                                        <td class="px-6 py-4 text-sm text-gray-500">
                                            {{ $product->currency }} {{ number_format($product->price, 2) }}
                                        </td>

                                        <!-- Description -->
                                        <td class="px-6 py-4 text-sm text-gray-500 max-w-xs break-words">
                                            @if($product->description)
                                                <div>
                                                    <div id="desc-short-{{ $product->id }}">
                                                        {{ Str::limit($product->description, 50) }}
                                                    </div>
                                                    <div id="desc-full-{{ $product->id }}" class="hidden">
                                                        {{ $product->description }}
                                                    </div>

                                                    @if(strlen($product->description) > 50)
                                                        <button onclick="toggleDescription({{ $product->id }})"
                                                                id="toggle-btn-{{ $product->id }}"
                                                                class="text-blue-600 hover:text-blue-800 text-xs">
                                                            Show All
                                                        </button>
                                                    @endif
                                                </div>
                                            @else
                                                <span class="text-gray-400">N/A</span>
                                            @endif
                                        </td>

                                        <!-- Actions -->
                                        <td class="px-6 py-4 text-sm font-medium">
                                            <div class="flex flex-col sm:flex-row sm:items-center gap-2">

                                                <!-- Edit -->
                                                <a href="{{ route('admin.products.edit', $product->id) }}"
                                                   class="px-4 py-2 bg-gray-800 text-white rounded-md text-xs hover:bg-gray-700">
                                                    Edit
                                                </a>

                                                <!-- Delete -->
                                                <form action="{{ route('admin.products.destroy', $product->id) }}"
                                                      method="POST"
                                                      onsubmit="return confirm('Are you sure you want to delete this product?');">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit"
                                                            class="px-4 py-2 bg-red-600 text-white rounded-md text-xs hover:bg-red-700">
                                                        Delete
                                                    </button>
                                                </form>

                                            </div>
                                        </td>

                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="px-6 py-8 text-center text-gray-500">
                                            No products found.
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

    <script>
        function toggleDescription(id) {
            const shortDesc = document.getElementById(`desc-short-${id}`);
            const fullDesc = document.getElementById(`desc-full-${id}`);
            const btn = document.getElementById(`toggle-btn-${id}`);

            if (fullDesc.classList.contains('hidden')) {
                shortDesc.classList.add('hidden');
                fullDesc.classList.remove('hidden');
                btn.textContent = 'Show Less';
            } else {
                fullDesc.classList.add('hidden');
                shortDesc.classList.remove('hidden');
                btn.textContent = 'Show All';
            }
        }
    </script>

</x-app-layout>
