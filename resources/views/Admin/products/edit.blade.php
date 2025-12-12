<x-app-layout title="Edit Product">
    <div class="flex h-full w-full flex-1 flex-col gap-8 p-8 bg-gray-50 dark:bg-zinc-900 overflow-y-auto">
        
        <!-- Header -->
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Edit Product</h1>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Update product information</p>
            </div>
            <a href="{{ route('admin.products.index') }}" 
               class="px-4 py-2 bg-gray-800 hover:bg-gray-700 text-white text-sm font-medium rounded-lg transition-colors shadow-sm">
                Back to Products
            </a>
        </div>

        <!-- Edit Form -->
        <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-sm border border-gray-100 dark:border-zinc-700 p-8">
            <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                    <!-- Product Name -->
                    <div>
                        <label for="name" class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">
                            Product Name <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               id="name" 
                               name="name" 
                               value="{{ old('name', $product->name) }}"
                               required
                               class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white text-gray-900 text-sm">
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Category -->
                    <div>
                        <label for="category" class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">
                            Category <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               id="category" 
                               name="category" 
                               value="{{ old('category', $product->category) }}"
                               required
                               class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white text-gray-900 text-sm">
                        @error('category')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Subcategory -->
                    <div>
                        <label for="subcategory" class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">
                            Subcategory
                        </label>
                        <input type="text" 
                               id="subcategory" 
                               name="subcategory" 
                               value="{{ old('subcategory', $product->subcategory) }}"
                               class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white text-gray-900 text-sm">
                        @error('subcategory')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Price -->
                    <div>
                        <label for="price" class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">
                            Price <span class="text-red-500">*</span>
                        </label>
                        <input type="number" 
                               id="price" 
                               name="price" 
                               value="{{ old('price', $product->price) }}"
                               step="0.01"
                               min="0"
                               required
                               class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white text-gray-900 text-sm">
                        @error('price')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Currency -->
                    <div>
                        <label for="currency" class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">
                            Currency <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               id="currency" 
                               name="currency" 
                               value="{{ old('currency', $product->currency) }}"
                               required
                               class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white text-gray-900 text-sm">
                        @error('currency')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- RAM -->
                    <div>
                        <label for="ram" class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">
                            RAM
                        </label>
                        <input type="text" 
                               id="ram" 
                               name="ram" 
                               value="{{ old('ram', $product->ram) }}"
                               placeholder="e.g., 8GB"
                               class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white text-gray-900 text-sm">
                        @error('ram')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Storage -->
                    <div class="md:col-span-1">
                        <label for="storage" class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">
                            Storage
                        </label>
                        <input type="text" 
                               id="storage" 
                               name="storage" 
                               value="{{ old('storage', $product->storage) }}"
                               placeholder="e.g., 256GB"
                               class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white text-gray-900 text-sm">
                        @error('storage')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Images Section -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 pt-4">
                    <!-- Current Image -->
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">
                            Current Image
                        </label>
                        <div class="border border-dashed border-gray-300 rounded-lg p-8 flex items-center justify-center bg-gray-50 min-h-[200px]">
                            @if($product->image)
                                @php
                                    $imageSrc = filter_var($product->image, FILTER_VALIDATE_URL) 
                                        ? $product->image 
                                        : asset($product->image);
                                @endphp
                                <img id="currentImage" 
                                     src="{{ $imageSrc }}" 
                                     alt="{{ $product->name }}" 
                                     class="max-w-full h-40 object-contain"
                                     onerror="this.onerror=null; this.parentElement.innerHTML='<div class=\'text-gray-400 text-sm\'>Image not available</div>';">
                            @else
                                <div class="text-gray-400 text-sm">No image available</div>
                            @endif
                        </div>
                    </div>

                    <!-- Upload New Image -->
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">
                            Upload New Image (Optional)
                        </label>
                        <div class="border border-dashed border-gray-300 rounded-lg p-8 bg-gray-50 min-h-[200px] flex flex-col justify-center">
                            <div class="flex items-center gap-4">
                                <label for="imageUpload" class="px-4 py-2 bg-blue-50 text-blue-600 text-sm font-medium rounded-lg cursor-pointer hover:bg-blue-100 transition-colors">
                                    Choose File
                                </label>
                                <span id="fileName" class="text-sm text-gray-500">No file chosen</span>
                            </div>
                            <input type="file" 
                                   id="imageUpload" 
                                   name="image_file" 
                                   accept="image/*"
                                   class="hidden"
                                   onchange="previewImage(event)">
                            
                            <p class="mt-4 text-xs text-gray-400">
                                Accepted formats: JPG, PNG, GIF, WebP (Max 2MB)
                            </p>

                            <!-- Preview for new upload -->
                            <div id="newImagePreview" class="mt-4 hidden">
                                <img id="previewImg" src="" alt="Preview" class="max-w-full h-32 object-contain rounded-lg border border-gray-200">
                            </div>
                        </div>
                        @error('image_file')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Description -->
                <div>
                    <label for="description" class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">
                        Description
                    </label>
                    <textarea id="description" 
                              name="description" 
                              rows="4"
                              class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white text-gray-900 text-sm">{{ old('description', $product->description) }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit Buttons -->
                <div class="flex items-center justify-end gap-3 pt-6 border-t border-gray-100">
                    <a href="{{ route('admin.products.index') }}" 
                       class="px-6 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-medium rounded-lg transition-colors">
                        Cancel
                    </a>
                    <button type="submit" 
                            class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors shadow-sm">
                        Update Product
                    </button>
                </div>
            </form>
        </div>

    </div>

    <script>
        function previewImage(event) {
            const file = event.target.files[0];
            const previewContainer = document.getElementById('newImagePreview');
            const previewImg = document.getElementById('previewImg');
            const fileNameDisplay = document.getElementById('fileName');
            
            if (file) {
                // Update file name
                fileNameDisplay.textContent = file.name;

                // Check file size (2MB max)
                if (file.size > 2 * 1024 * 1024) {
                    alert('File size must be less than 2MB');
                    event.target.value = '';
                    fileNameDisplay.textContent = 'No file chosen';
                    previewContainer.classList.add('hidden');
                    return;
                }
                
                // Check file type
                const validTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/webp'];
                if (!validTypes.includes(file.type)) {
                    alert('Please select a valid image file (JPG, PNG, GIF, or WebP)');
                    event.target.value = '';
                    fileNameDisplay.textContent = 'No file chosen';
                    previewContainer.classList.add('hidden');
                    return;
                }
                
                // Show preview
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImg.src = e.target.result;
                    previewContainer.classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            } else {
                fileNameDisplay.textContent = 'No file chosen';
                previewContainer.classList.add('hidden');
            }
        }
    </script>
</x-app-layout>
